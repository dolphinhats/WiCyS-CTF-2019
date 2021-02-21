from http.server import BaseHTTPRequestHandler, HTTPServer
import time
import urllib.parse as urlparse

HOST = '0.0.0.0'
PORT = 7002

challenge_file = open('flag12.txt', 'r') # open the file to read
challenge_data = challenge_file.readlines() # stores a list of lines from the file

# create an HTTP handler based on the existing BaseHTTPRequestHandler
class HTTPHandler(BaseHTTPRequestHandler):

    def do_GET(self): # generate the status code for the GET request
        self.respond({'status': 200})

    def handle_http(self, status_code, path): # handle the request
        self.send_response(status_code)
        self.send_header('Content-type', 'text/html')
        self.end_headers()

        lines_num = 1
        output = ''

        # this will define how many lines of data the user can read from the file
        # read about GET parameters here: https://en.ryte.com/wiki/GET_Parameter
        lines_to_read = urlparse.urlparse(path) # read the GET parameters from the URL that user requested
        if 'lines' in urlparse.parse_qs(lines_to_read.query): # read more lines if the user requested to do so
            try:
                lines_num = int(urlparse.parse_qs(lines_to_read.query)['lines'][0])
            except:
                lines_num = 1

        # read the file and show it to the user
        for i in range(0, lines_num):
            if i >= len(challenge_data): break
            output += challenge_data[i] + '<br>'

        # generate the output to show to the user
        current_output = '''<p>{}</p>'''.format(output)

        # make the HTML page to show the user and insert current_output there
        content = ''.join(open('index.html', 'r')).replace('CONTENT_PLACEMENT', current_output)

        return bytes(content, 'UTF-8')

    def respond(self, opts):
        response = self.handle_http(opts['status'], self.path)
        self.wfile.write(response)

if __name__ == '__main__':
    server = HTTPServer
    httpd = server((HOST, PORT), HTTPHandler)
    print(time.asctime(), 'Server Starts - %s:%s' % (HOST, PORT))
    try:
        httpd.serve_forever()
    except KeyboardInterrupt:
        pass
    httpd.server_close()
    print(time.asctime(), 'Server Stops - %s:%s' % (HOST, PORT))
