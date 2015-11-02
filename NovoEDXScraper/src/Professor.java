
public class Professor {
    public final String profName, profImage;

    public Professor(String profName, String profImage) {
        this.profName = profName;
        this.profImage = profImage;
    }

    @Override
    public String toString() {
        return "Professor{" +
                "profName='" + profName + '\'' +
                ", profImage='" + profImage + '\'' +
                '}';
    }
}
