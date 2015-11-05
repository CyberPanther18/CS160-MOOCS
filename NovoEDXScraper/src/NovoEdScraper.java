import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import java.io.File;
import java.io.IOException;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.*;
import java.util.concurrent.TimeUnit;

/**
 * The NovoEdScraper.
 */
public class NovoEdScraper {
    private String[] endingPunct = {".", "?", "!"};//Punctuation marks to end sentences
    
    public Map<Course, List<Professor>> start() {
        Map<Course, List<Professor>> courseToProfessorListMap = new TreeMap<>();

        try {
            File folder = new File("novoEd");
            for(File file : folder.listFiles()) {
                List<Professor> professorList = new ArrayList<>();

                String filename = file.getName();
                File input = new File("novoEd/" + filename);
                Document doc = Jsoup.parse(input, "UTF-8", "");
                //System.out.println("https://novoed.com/" + filename.replace(".txt", ""));

                // professors
                // prof names
                List<String> profNameList = new ArrayList<>();
                Elements profNameElements = doc.select("span.instructor_name");
                for (Element element : profNameElements) {
                    String profName = element.text();
                    int commaIndex = profName.lastIndexOf(",");
                    if (commaIndex != -1) {
                        profName = profName.substring(0, commaIndex);
                    }
                    profNameList.add(profName);
                }

                // prof images
                Elements profImageElements = doc.select("img.person");
                for(int i = 0; i < profImageElements.size(); i++) {
                    Element element = profImageElements.get(i);
                    String profImage = element.attr("src");
                    int jpgIndex = profImage.indexOf("?");
                    if (jpgIndex != -1) {
                        profImage = profImage.substring(0, jpgIndex);
                    }

                    // add new professor
                    Professor professor = new Professor(profNameList.get(i), profImage);
                    professorList.add(professor);
                    //System.out.println(professor);
                }
                // no professor image
                if(profImageElements.size() == 0) {
                    for(String profName : profNameList) {
                        // add new professor
                        Professor professor = new Professor(profName, "");
                        professorList.add(professor);
                        //System.out.println(professor);
                    }
                }

                // course
                // title
                String title = doc.select("h1").first().text();

                // long desc
                String descSelector = "h3.course + p";
                String longDesc = doc.select(descSelector).text();

                int maxAttempts = 3;
                int currentAttempt = 1;
                int minDescLen = 30;
                while(longDesc.length() < minDescLen && currentAttempt <= maxAttempts)
                {
                    descSelector += " + p"; //Look at next paragraph if current one fails
                    longDesc = doc.select(descSelector).text();
                    currentAttempt++;
                }
                //last try at long desc
                if(longDesc.length() < minDescLen)
                    {
                    currentAttempt = 1;
                    descSelector = "p";
                    longDesc = doc.select(descSelector).text();
                    while(longDesc.length() < minDescLen && currentAttempt <= maxAttempts)
                    {
                        descSelector += " + p"; //Look at next paragraph if current one fails
                        longDesc = doc.select(descSelector).text();
                        currentAttempt++;
                    }
                }

                // short desc
                int smallestIndex = -1;
                for(String punctMark: endingPunct)
                {
                    int indexOfPunct = longDesc.indexOf(punctMark);
                    if(smallestIndex == -1 || (indexOfPunct > -1 && indexOfPunct < smallestIndex))
                    {
                        smallestIndex = indexOfPunct;
                    }
                }
                String shortDesc = longDesc.substring(0, smallestIndex + 1);

                // course link
                String courseLink = "https://novoed.com/" + filename.replace(".txt", "");

                // video link
                String videoLink = doc.select("iframe[src^=https://www.youtube.com/embed/]").attr("src");

                // date and course length
                String startDateString = "";
                int courseLength = -1;
                Elements dateElements = doc.select("span[data-utc-time]");
                if(dateElements.size() == 2) {
                    startDateString = dateElements.get(0).attr("data-utc-time");
                    startDateString = startDateString.substring(0, startDateString.lastIndexOf("T"));
                    String endDateString = dateElements.get(1).attr("data-utc-time");
                    endDateString = endDateString.substring(0, endDateString.lastIndexOf("T"));

                    try {
                        SimpleDateFormat simpleDateFormat = new SimpleDateFormat("yyyy-MM-dd");
                        Date startDate = simpleDateFormat.parse(startDateString);
                        Date endDate = simpleDateFormat.parse(endDateString);
                        long diff = endDate.getTime() - startDate.getTime();
                        courseLength = (int) TimeUnit.DAYS.convert(diff, TimeUnit.MILLISECONDS);
                    }
                    catch(ParseException e) {
                        e.printStackTrace();
                    }
                }

                // course image
                String courseImage = "";

                // category
                String category = "";

                // site
                String site = "https://novoed.com/";


                // language
                String language = courseLink.endsWith("-es") ? "Spanish" : "English"; // this site only has classes in English and Spanish

                // certificate, course fee, and university
                int courseFee = -1; // see https://novoed.com/Introduction-Negotiation-Fall-2015
                boolean certificate = false;
                String priceTag = doc.select("figure.pricetag").text();
                String university = priceTag.replace("A free course from ", "");
                String certificateString = "You have the opportunity to sign up for a certificate of completion for $";
                String moneyString = "You can take this course for $";
                int certificateIndex = university.lastIndexOf(certificateString);
                int moneyIndex = university.lastIndexOf(moneyString);
                if(certificateIndex != -1) {
                    courseFee = (int) Double.parseDouble(university.substring(certificateIndex + certificateString.length(), university.length() - 1));
                    university = university.substring(0, certificateIndex); // this must come after courseFee
                    certificate = true;
                }
                else if(moneyIndex != -1) {
                    courseFee = (int) Double.parseDouble(university.substring(moneyIndex + moneyString.length(), university.length() - 1));
                    university = university.substring(0, moneyIndex); // this must come after courseFee
                    certificate = true;
                }

                // current time
                TimeZone tz = TimeZone.getTimeZone("UTC");
                DateFormat df = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
                df.setTimeZone(tz);
                String timeScraped  = df.format(new Date());

                // add new course
                Course course = new Course(title, shortDesc, longDesc, courseLink, videoLink,
                        startDateString, courseLength, courseImage, category, site,
                        courseFee, language, certificate, university, timeScraped);
                //System.out.println(course);
                //System.out.println();

                // add to map
                courseToProfessorListMap.put(course, professorList);
            }
        }
        catch(IOException e) {
            e.printStackTrace();
        }

        return courseToProfessorListMap;
    }
}
