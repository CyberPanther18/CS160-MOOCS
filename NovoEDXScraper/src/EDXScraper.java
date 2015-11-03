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
                System.out.println("https://www.edx.org/course/" + filename.replace(".txt", ""));

                // professors
                // get prof names
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

                // get prof images
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
                String longDesc = doc.select("div.see-more-content > p").text();
                String shortDesc = longDesc.substring(0, longDesc.indexOf(".") + 1);
                String courseLink = "https://edx.org/course/" + filename.replace(".txt", "");
                String videoLink = doc.select("meta[content$=autohide=1").attr("content");

                // get date
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
                        e.printStackTrace();
                    }
                }
                else if(!startDateString.isEmpty()) {
                    startDateString = "";
                }

                String courseLengthString = doc.select("li > span.block-list__desc").first().text();
                int courseLength = -1;
                if(courseLengthString.matches("[0-9]+ weeks")) {
                    courseLengthString = courseLengthString.substring(0, courseLengthString.indexOf(" "));
                    courseLength = Integer.parseInt(courseLengthString) * 7;
                }

                String courseImage = doc.select("a.video-link > img").attr("src");

                String category = doc.select("li[data-field=subject] > span.block-list__desc").text();
                String site = "https://edx.org/";

                Elements languageElements = doc.select("li > span.block-list__desc");
                String language = languageElements.get(languageElements.size() - 2).text();
                int languageIndex = language.indexOf(",");
                if(languageIndex != -1) {
                    language = language.substring(0, languageIndex);
                }

                boolean certificate = false;

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

                String university = doc.select("li[data-field=school] > span.block-list__desc").text();

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
                courseList.add(course);
                System.out.println(course);

                System.out.println();
            }
        }
        catch(IOException e) {
            e.printStackTrace();
        }
    }
}
