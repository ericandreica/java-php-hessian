import com.caucho.hessian.client.HessianProxyFactory;

import java.io.BufferedReader;
import java.io.InputStreamReader;

public class JavaClient {
    public JavaClient(String urlServ) throws Exception {
        BufferedReader reader = new BufferedReader(new InputStreamReader(System.in));
        System.out.println("Client Hessian Java: " + urlServ);
        HessianProxyFactory hpf = new HessianProxyFactory();
        hpf.setHessian2Request(true); // client pentru php
        ServerInterface proxy = (ServerInterface) hpf.create(ServerInterface.class, urlServ);
        try {
            int exit = 0;
            while (true) {
                menu();
                String op = reader.readLine();
                switch (op) {
                    case "0":
                        System.out.println("Exit...");
                        exit = 1;
                        break;
                    case "1":
                        System.out.println("List is: ");
                        System.out.println(proxy.listAll());
                        break;
                    case "2":
                        System.out.println("File name: ");
                        String name = reader.readLine();
                        System.out.println("Result: " + proxy.getByName(name));
                        break;
                    case "3":
                        System.out.println("Content: ");
                        String content = reader.readLine();
                        System.out.println("Result: " + proxy.getByContentString(content));
                        break;
                    case "4":
                        System.out.println("Content: ");
                        String bytes = reader.readLine();
                        System.out.println("Result: " + proxy.getByContentBytes(bytes));
                        break;
                    case "5":
                        System.out.println("Hash: ");
                        String hash = reader.readLine();
                        System.out.println("Result: " + proxy.getByHash(hash));
                        break;
                    default:
                        System.out.println("Bad input");
                }
                if (exit == 1)
                    break;
            }
        }catch (Exception e){
            System.out.println("Error: "+e.getMessage());
        }

    }

    public void menu() {
        System.out.println("1:List");
        System.out.println("2:Get by name");
        System.out.println("3:Search by content as string");
        System.out.println("4:Search by content as bytes");
        System.out.println("5:Search by hash");
        System.out.println("0:Exit");
    }


    public static void main(String[] args) throws Exception {

        new JavaClient("http://localhost:9090/hess");
//        new JavaClient("http://localhost/PHPServer.php");
    }
}
