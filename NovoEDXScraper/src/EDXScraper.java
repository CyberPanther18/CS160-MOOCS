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

/**
 * The EDXScraper.
 */
public class EDXScraper {
    
    private String[] endingPunct = {".", "?", "!"};//Punctuation marks to end sentences
    
    public Map<Course, List<Professor>> start() {
        Map<Course, List<Professor>> courseToProfessorListMap = new TreeMap<>();

        try {
            File folder = new File("edx");
            for(File file : folder.listFiles()) {
                List<Professor> professorList = new ArrayList<>();

                String filename = file.getName();
                File input = new File("edx/" + filename);
                Document doc = Jsoup.parse(input, "UTF-8", "");
                //System.out.println("https://www.edx.org/course/" + filename.replace(".txt", ""));

                // professors
                // prof names
                List<String> profNameList = new ArrayList<>();
                Elements profNameElements = doc.select("p.instructor-name");
                for (Element element : profNameElements) {
                    String profName = element.text();
                    int commaIndex = profName.lastIndexOf(",");
                    if (commaIndex != -1) {
                        profName = profName.substring(0, commaIndex);
                    }
                    profNameList.add(profName);
                }

                // prof images
                Elements profImageElements = doc.select("img.instructor-img");
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
                String longDesc = doc.select("div.see-more-content > p").text();

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
                String courseLink = "https://edx.org/course/" + filename.replace(".txt", "");

                // video link
                String videoLink = doc.select("meta[content$=autohide=1").attr("content");

                // start date
                String startDateString = doc.select("div.course-start > span").text();
                if(startDateString.contains(" on ")) {
                    startDateString = startDateString.substring(startDateString.indexOf(" on ") + 4);
                    try {
                        SimpleDateFormat simpleDateFormat = new SimpleDateFormat("MMMMM dd, yyyy");
                        Date startDate = simpleDateFormat.parse(startDateString);
                        Calendar cal = Calendar.getInstance();
                        cal.setTime(startDate);
                        int year = cal.get(Calendar.YEAR);
                        int month = cal.get(Calendar.MONTH) + 1;
                        int day = cal.get(Calendar.DAY_OF_MONTH);
                        startDateString = String.format("%d-%02d-%02d", year, month, day);
                    }
                    catch(ParseException e) {
                        try {
                            // catch Month Year format
                            SimpleDateFormat simpleDateFormat = new SimpleDateFormat("MMMMM yyyy");
                            Date startDate = simpleDateFormat.parse(startDateString);
                            Calendar cal = Calendar.getInstance();
                            cal.setTime(startDate);
                            int year = cal.get(Calendar.YEAR);
                            int month = cal.get(Calendar.MONTH) + 1;
                            int day = 1;
                            startDateString = String.format("%d-%02d-%02d", year, month, day);
                        }
                        catch(ParseException e1) {
                            e1.printStackTrace();
                        }
                    }
                }
                else if(!startDateString.isEmpty()) {
                    startDateString = "";
                }

                // course length
                String courseLengthString = doc.select("li > span.block-list__desc").first().text();
                int courseLength = -1;
                if(courseLengthString.matches("[0-9]+ weeks")) {
                    courseLengthString = courseLengthString.substring(0, courseLengthString.indexOf(" "));
                    courseLength = Integer.parseInt(courseLengthString) * 7;
                }

                // course image
                String courseImage = doc.select("a.video-link > img").attr("src");

                // category
                String category = doc.select("li[data-field=subject] > span.block-list__desc").text();

                // site
                String site = "https://edx.org/";

                // language

                Elements languageElements = doc.select("li[data-field=language] > span.block-list__desc");
                String language = languageElements.first().text();
                int languageIndex = language.indexOf(",");
                if(languageIndex != -1) {
                    language = language.substring(0, languageIndex);
                }
                

                // course fee
                int courseFee = -1;
                String priceTag = doc.select("li[data-field=price] > span.block-list__desc").text();
                if(priceTag.startsWith("Free")) {
                    courseFee = 0;
                }
                else {
                    priceTag = doc.select("li > span.block-list__desc").get(3).text();

                    if(priceTag.startsWith("$")) {
                        priceTag = priceTag.substring(1);
                        courseFee = Integer.parseInt(priceTag);
                    }
                }

                // university
                String university = doc.select("li[data-field=school] > span.block-list__desc").text();

                // certificate
                boolean certificate = false;
                String certificateString = "certificate";
                int certificateIndex = priceTag.toLowerCase().lastIndexOf(certificateString);
                if(certificateIndex != -1) {
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
