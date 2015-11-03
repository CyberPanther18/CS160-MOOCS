import java.util.List;

/**
 * The NovoEDXScraper.
 */
public class NovoEDXScraper {
    public static void main(String[] args) {
        //save("novoEd");
        //System.out.println();
        //save("edx");

        /*NovoEdScraper novoEdScraper = new NovoEdScraper();
        novoEdScraper.start();*/

        EDXScraper edxScraper = new EDXScraper();
        edxScraper.start();
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
