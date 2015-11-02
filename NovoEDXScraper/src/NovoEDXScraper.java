import java.util.List;

public class NovoEDXScraper {
    public static void main(String[] args) {
        //save("novoEd");
        //System.out.println();
        //save("edx");
        // sample edx professor images
        // https://www.edx.org/sites/default/files/person/image/michael_buffa-110x110.png
        // https://www.edx.org/sites/default/files/person/image/mx101z-chen-110x110.png



        // jsoup attempt to load data, but since they use javascript to generate the page jsoup fails to load the data
        // tried using phantomjs to load the page with javascript but it didn't work out
        NovoEdScraper novoEdScraper = new NovoEdScraper();
        novoEdScraper.start();

        /*EDXScraper edxScraper = new EDXScraper();
        edxScraper.start();*/
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
