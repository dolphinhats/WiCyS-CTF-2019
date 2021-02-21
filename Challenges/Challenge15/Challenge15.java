import java.io.IOException;
import java.io.OutputStream;
import java.net.InetSocketAddress;
import java.util.Random;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileReader;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.util.Map;
import java.util.HashMap;

import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;

public class Challenge15 {

    static private String data = "";
    static private String adminPassword = "";

    public static void main(String[] args) throws Exception {
        // create a secure admin!
        // we will generate a random password
        // so that nobody will be able to log in as admin
        // even we do not know what the password is,
        // how smart is that, huh?
        adminPassword = generateSecurePassword();
        
        // read the challenge file and store it in the data
        File file = new File("flag15.txt");
        BufferedReader br = new BufferedReader(new FileReader(file));
        String line = "";
        while ((line = br.readLine()) != null) data += line + "<br>";
        br.close();
        
        // run the HTTP server to listen for connections
        int port = 7005;
        HttpServer server = HttpServer.create(new InetSocketAddress(port), 0);
        server.createContext("/login/", new LoginHandler());
        server.createContext("/", new IndexHandler());
        server.setExecutor(null);
        server.start();
        System.out.println("Started the server on port " + port + "...");
    }

    // this class takes care of the action when the user clicks on Login
    static class LoginHandler implements HttpHandler {
        @Override
        public void handle(HttpExchange t) throws IOException {
            String output = "";
            Map<String, String> GETRequestParams = queryToMap(t.getRequestURI().getQuery());
            if (GETRequestParams.containsKey("username") && GETRequestParams.containsKey("password")) {
                String username = GETRequestParams.get("username");
                String password = GETRequestParams.get("password");

                if (username.equals("admin") && password.equals(adminPassword)) {
                    output += data;
                }
                else {
                    output += "Username/password are not correct! Good luck next time.";
                }
            }
            else {
                output += "GET parameters are wrong, don't mess with us ;)";
            }
            
            generateResponse(t, output);
        }
    }
    
    // this class takes care of the action when the user navigates to this challenge
    static class IndexHandler implements HttpHandler {
        @Override
        public void handle(HttpExchange t) throws IOException {
            generateResponse(t, "Dear admin, hopefully, you remember your password!");
        }
    }
    
    // a method for a generic response to the user
    static void generateResponse(HttpExchange t, String output) throws IOException {
        String line = "", response = "";
        try {
            File indexFile = new File("index.html").getCanonicalFile();
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(new FileInputStream(indexFile)));
            while ((line = bufferedReader.readLine()) != null) {
                response += line;
            }
            response = response.replaceAll("CONTENT_PLACEMENT", output);
            bufferedReader.close();
        } catch (IOException e) {
            e.printStackTrace();
        }
        t.getResponseHeaders().add("Content-Type", "text/html");
        t.sendResponseHeaders(200, response.length());
        OutputStream os = t.getResponseBody();
        os.write(response.getBytes());
        os.close();
    }
    
    static public Map<String, String> queryToMap(String query) {
        Map<String, String> result = new HashMap<>();
        for (String param : query.split("&")) {
            String[] entry = param.split("=");
            if (entry.length > 1) { // proceed only when there is a pair of parameters
                result.put(entry[0], entry[1]);
            }
        }
        return result;
    }
    
    static private String generateSecurePassword() {
        String password = "magicallysecure";  
        Random rnd = new Random();

        // generate a random number between 0 and 20 and based on that, create a password
        Integer random = rnd.nextInt(20);

        // let's do some math on that number
        // btw, this code can be run on the website like https://www.jdoodle.com/online-java-compiler
        // just don't forget to import java.util.Random; at the top of the code editor
        random = random * 16578;
        random = random ^ 654321;
        for (int i = 0; i < password.length(); i++) {
            random += (int)password.charAt(i); // convert every character from password to an integer according to ASCII table and add that number to random
        }

        password = random.toString();

        return password;
    }

}