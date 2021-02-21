import java.io.IOException;
import java.io.OutputStream;
import java.io.UnsupportedEncodingException;
import java.net.InetSocketAddress;
import java.util.Random;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileReader;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.util.Map;
import java.util.HashMap;
import java.util.Arrays;
import java.security.MessageDigest;

import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;

public class Challenge16 {

    static private String data = "";
    static private String adminPasswordHash = "";

    public static void main(String[] args) throws Exception {
        // hashing the password helps security
        // this hash corresponds to one of the commonly used passwords in 2018
        // just for testing purposes, please change when deploying in production!!!
        adminPasswordHash = "0571749e2ac330a7455809c6b0e7af90";
        
        // read the challenge file and store it in the data
        File file = new File("flag16.txt");
        BufferedReader br = new BufferedReader(new FileReader(file));
        String line = "";
        while ((line = br.readLine()) != null) data += line + "<br>";
        br.close();
        
        // run the HTTP server to listen for connections
        int port = 7006;
        HttpServer server = HttpServer.create(new InetSocketAddress(7006), 0);
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

                if (username.equals("admin") && md5hash(password).equals(adminPasswordHash)) {
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
            generateResponse(t, "Hash the cash, cash the hash");
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
    
    // calculates MD5 hash of the input String
    static public String md5hash(String s) {
        try {
            byte[] bytesOfMessage = s.getBytes("UTF-8");
            MessageDigest md = MessageDigest.getInstance("MD5");
            StringBuffer sb = new StringBuffer();
            for (byte b : md.digest(bytesOfMessage)) {
                sb.append(String.format("%02x", b & 0xff));
            }
            return sb.toString();
        }
        catch(Exception e) {
            System.out.println(e.getMessage());
        }
        return null;
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