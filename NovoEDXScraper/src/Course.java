/**
 * The Course.
 */
public class Course {
    public final String title, shortDesc, longDesc, courseLink, videoLink,
            startDate, courseImage, category, site,
            language, university, timeScraped;
    public final int courseLength, courseFee;
    public final boolean certificate;

    public Course(String title, String shortDesc, String longDesc, String courseLink, String videoLink,
                  String startDate, int courseLength, String courseImage, String category, String site,
                  int courseFee, String language, boolean certificate, String university, String timeScraped) {
        this.title = title;
        this.shortDesc = shortDesc;
        this.longDesc = longDesc;
        this.courseLink = courseLink;
        this.videoLink = videoLink;
        this.startDate = startDate;
        this.courseLength = courseLength;
        this.courseImage = courseImage;
        this.category = category;
        this.site = site;
        this.courseFee = courseFee;
        this.language = language;
        this.certificate = certificate;
        this.university = university;
        this.timeScraped = timeScraped;
    }

    @Override
    public String toString() {
        return "Course{" +
                "title='" + title + '\'' +
                ", shortDesc='" + shortDesc + '\'' +
                ", longDesc='" + longDesc + '\'' +
                ", courseLink='" + courseLink + '\'' +
                ", videoLink='" + videoLink + '\'' +
                ", startDate='" + startDate + '\'' +
                ", courseLength='" + courseLength + '\'' +
                ", courseImage='" + courseImage + '\'' +
                ", category='" + category + '\'' +
                ", site='" + site + '\'' +
                ", courseFee='" + courseFee + '\'' +
                ", language='" + language + '\'' +
                ", certificate='" + certificate + '\'' +
                ", university='" + university + '\'' +
                ", timeScraped='" + timeScraped + '\'' +
                '}';
    }
}
