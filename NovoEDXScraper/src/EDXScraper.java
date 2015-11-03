import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;

import java.io.File;
import java.io.IOException;
import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.TimeZone;
import java.util.concurrent.TimeUnit;

public class EDXScraper {
    public void start() {
        try {
            // professors and courses
            List<Professor> professorList = new ArrayList<>();
            List<Course> courseList = new ArrayList<>();

            File folder = new File("edx");
            for(File file : folder.listFiles()) {
                //String filename = "how-writers-write-fiction-2015.txt";
                String filename = file.getName();
                File input = new File("edx/" + filename);
                Document doc = Jsoup.parse(input, "UTF-8", "");
                System.out.println("https://edx.com/" + filename.replace(".txt", ""));

                // professors
                // get prof names
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

                // get prof images
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
                    System.out.println(professor);
                }
                // no professor image
                if(profImageElements.size() == 0) {
                    for(String profName : profNameList) {
                        // add new professor
                        Professor professor = new Professor(profName, "");
                        professorList.add(professor);
                        System.out.println(professor);
                    }
                }

                // course
                String title = doc.select("h1").first().text();
                String longDesc = doc.select("h3.course + p").text();
                String shortDesc = longDesc.substring(0, longDesc.indexOf(".") + 1);
                String courseLink = "https://novoed.com/" + filename.replace(".txt", "");
                String videoLink = doc.select("iframe[src$=.com]").attr("src");

                // get date
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

                String courseImage = "";
                String category = "";
                String site = "https://novoed.com/";
                int courseFee = -1; // see https://novoed.com/Introduction-Negotiation-Fall-2015
                String language = courseLink.endsWith("-es") ? "Spanish" : "English"; // this site only has classes in English and Spanish
                boolean certificate = false;
                String priceTag = doc.select("figure.pricetag").text();
                String university = priceTag.replace("A free course from ", "");
                String certificateString = "You have the opportunity to sign up for a certificate of completion for $";
                int certificateIndex = university.lastIndexOf(certificateString);
                if(certificateIndex != -1) {
                    courseFee = (int) Double.parseDouble(university.substring(certificateIndex + certificateString.length(), university.length() - 1));
                    university = university.substring(0, certificateIndex); // this must come after courseFee
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
                courseList.add(course);
                System.out.println(course);

                System.out.println();
            }

            // database code goes here

        }
        catch(IOException e) {
            e.printStackTrace();
        }
    }
}
