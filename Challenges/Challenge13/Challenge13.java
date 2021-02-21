import java.io.IOException;
import java.io.OutputStream;
import java.net.InetSocketAddress;
import java.util.HashMap;
import java.util.Map;
import java.util.Random;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileReader;
import java.io.BufferedReader;
import java.io.InputStreamReader;

import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;

public class Challenge13 {

    // database stores 'username, password' pairs
    static private Map<String, String> database = new HashMap<String, String>();
    static private String data = "";

    public static void main(String[] args) throws Exception {
        // create a secure admin!
        // we will generate a long random password
        // so that nobody will be able to log in as admin!
        // how smart is that, huh?
        String password = generateSecurePassword();
        database.put("admin", password);
        
        // read the challenge file and store it in the data
        File file = new File("flag13.txt");
        BufferedReader br = new BufferedReader(new FileReader(file));
        String line = "";
        while ((line = br.readLine()) != null) data += line + "<br>";
        br.close();
        
        // run the HTTP server to listen for connections
        HttpServer server = HttpServer.create(new InetSocketAddress(7003), 0);
        server.createContext("/register/", new RegisterHandler());
        server.createContext("/login/", new LoginHandler());
        server.createContext("/", new IndexHandler());
        server.setExecutor(null);
        server.start();
    }

    // this class takes care of the action when the user clicks on Register
    static class RegisterHandler implements HttpHandler {
        @Override
        public void handle(HttpExchange t) throws IOException {
            String output = "";
            Map<String, String> GETRequestParams = queryToMap(t.getRequestURI().getQuery());
            if (GETRequestParams.containsKey("username") && GETRequestParams.containsKey("password")) {
                String username = GETRequestParams.get("username");
                String password = GETRequestParams.get("password");
                // fix the spaces
                username = username.replaceAll("\\+", " ");
                password = password.replaceAll("\\+", " ");
                if (!database.containsKey(username)) { // proceed only if the database does not have this username
                    if (password.length() < 8) {
                        output += "The password should be at least 8 characters long";
                    }
                    else { // good to go with saving the new user info to the database
                        
                        // we decided not to store usernames longer than 32 characters
                        // so we will just cut the name until 32 
                        if (username.length() > 32) username = username.substring(0, 32);
                        
                        // truncate all whitespaces from left and right before saving
                        username = username.trim();
                        
                        // create a new user; warning: it overwrites the previous one if already exists
                        database.put(username, password);
                        output += "The username \"" + username + "\" has been successfully registered!";
                    }
                }
                else { // the name already exists
                    output += "This username already exists, best of luck with another one :)";
                }
            }
            else {
                output += "GET parameters are wrong, don't mess with us ;)";
            }
            
            generateResponse(t, output);
        }
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
                // fix the spaces
                username = username.replaceAll("\\+", " ");
                password = password.replaceAll("\\+", " ");
                // ladies and gents, this is just for fun
                if (!username.equals("admin") && password.equals("magicallysecure")) {
                    output += "It was worth trying. But nope, wrong approach. Try breaking into this app from a different angle. Besides, admin's password is not magically secure -- it is magically strong.";
                }
                else if (!username.equals("admin") && (password.equals("magicallystrong") || password.equals("magically strong"))) {
                    output += "Good try! But still, wrong approach. Try another angle.";
                }

                // check if the name and the corresponding password are in our database
                if (database.containsKey(username) && database.get(username).equals(password)) {
                    if (username.equals("admin")) {
                        output += data;
                        // rewrite the admin password so that no one else can see what you see
                        database.put("admin", generateSecurePassword());
                    }
                    else {
                        output += "Logged in! But your goal is to login as admin, not as " + username + ". Try again.";
                    }
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
            generateResponse(t, "admin has secured her account with a long password :-P");
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
        String caps     = "QWERTYUIOPASDFGHJKLZXCVBNM";
        String smalls   = "qwertyuiopasdfghjklzxcvbnm";
        String nums     = "1234567890";
        String syms     = "!@#$%^&*()_+-=<>?,./;:";
        
        String all = caps + smalls + nums + syms;
        
        Random rnd = new Random();
 
        // create a 64-character long password!
        // there is no way anyone can brute force that
        // this is not reverse psychology
        // DO NOT try to brute force the password
        for (int i = 0; i < 64; i++) {
            password += all.charAt(rnd.nextInt(all.length()));
        }
        return password;
    }

}