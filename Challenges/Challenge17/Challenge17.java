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

public class Challenge17 {

    static private String data = "";
    static private String adminPassword = "";
    static private String adminUsername = "";

    public static void main(String[] args) throws Exception {
        // reading the password from the file
        File filePass = new File("passwordANDusername.txt");
        BufferedReader br = new BufferedReader(new FileReader(filePass));
        adminPassword = br.readLine();
        adminUsername = br.readLine();
        br.close();

        // read the challenge file and store it in the data
        File file = new File("flag17.txt");
        br = new BufferedReader(new FileReader(file));
        String line = "";
        while ((line = br.readLine()) != null) data += line + "<br>";
        br.close();
        
        // run the HTTP server to listen for connections
        int port = 7007;
        HttpServer server = HttpServer.create(new InetSocketAddress(port), 0);
        server.createContext("/auth.log", new LogHandler());
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

                if (username.equals(adminUsername) && password.equals(adminPassword)) {
                    output += data;
                }
                else {
                    // all errors will be recorded in auth.log file
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
            generateResponse(t, "Millions of red roses, or red roses for millions");
        }
    }

    // this class takes care of the action when the user navigates to this challenge
    static class LogHandler implements HttpHandler {
        @Override
        public void handle(HttpExchange t) throws IOException {
            // read the challenge file and store it in the data
            File file = new File("auth.log");
            BufferedReader br = new BufferedReader(new FileReader(file));
            String line = "";
            String out = "";
            while ((line = br.readLine()) != null) out += line + "<br>";
            br.close();
            generateResponse(t, out);
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

}