import com.caucho.hessian.server.HessianServlet;
import org.eclipse.jetty.server.Server;
import org.eclipse.jetty.servlet.ServletHandler;
import repo.Repo;
import repo.RepoClass;

public class JavaServer extends HessianServlet implements ServerInterface {
    Repo repo = new RepoClass("D:\\java-hes\\src\\myfile.txt");

    public String getByName(String name) {
        return repo.searchByName(name);
    }

    public String getByContentString(String content) {
        return repo.searchByContentString(content);
    }

    public String getByContentBytes(String bytes) {
        return repo.searchByContentBytes(bytes);
    }

    public String getByHash(String hash) {
        return repo.searchByHash(hash);
    }

    public String listAll() {
        return repo.listAll();
    }

    public static void main(String[] args) throws Exception {
        Server service = new Server(9090);
        ServletHandler handler = new ServletHandler();
        service.setHandler(handler);
        handler.addServletWithMapping(JavaServer.class, "/hess");
        System.out.println("Start server JavaServer, jetty embedded, wait at 9090");
        service.start();
        service.join();

    }
}
