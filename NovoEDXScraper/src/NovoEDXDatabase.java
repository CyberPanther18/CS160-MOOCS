import java.util.List;
import java.util.Map;

/**
 * The NovoEDXDatabase.
 */
public class NovoEDXDatabase {
    public void start(Map<Course, List<Professor>> courseToProfessorListMap) {
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
}
