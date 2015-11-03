import java.util.List;
import java.util.Map;
import java.util.TreeMap;

/**
 * The NovoEDXScraper.
 */
public class NovoEDXScraper {
    public static void main(String[] args) {
        // generate cached .txt files
        //save("novoEd");
        //System.out.println();
        //save("edx");

        // generate NovoEd course to professor list map
        NovoEdScraper novoEdScraper = new NovoEdScraper();
        Map<Course, List<Professor>> novoEdCourseToProfessorListMap =  novoEdScraper.start();

        // generate edx course to professor list map
        EDXScraper edxScraper = new EDXScraper();
        Map<Course, List<Professor>> edxCourseToProfessorListMap = edxScraper.start();

        // combine maps
        Map<Course, List<Professor>> courseToProfessorListMap = new TreeMap<>();
        courseToProfessorListMap.putAll(novoEdCourseToProfessorListMap);
        courseToProfessorListMap.putAll(edxCourseToProfessorListMap);

        // database code goes here
        // go through maps
        int courseID = 0;
        for(Course course : courseToProfessorListMap.keySet()) {
            System.out.println(String.format("%3d", courseID) + " " + course);
            for(Professor professor : courseToProfessorListMap.get(course)) {
                System.out.println("        " + professor);
            }
            System.out.println();
            courseID++;
        }
    }

    /**
     * Save the data from the site's links.
     * @param site the site
     */
    private static void save(String site) {
        List<String> links = DataTool.loadAsList(site + " links.txt");
        for (int i = 0; i < links.size(); i++) {
            String link = links.get(i);
            String title = link.substring(link.lastIndexOf("/") + 1);
            String filename = site + "/" + title + ".txt";
            System.out.println(i + " " + link + " > " + filename);
            LinkTool.save(filename, link);
        }
    }
}
