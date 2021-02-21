from http.server import BaseHTTPRequestHandler, HTTPServer
import time
import re
import subprocess
import random
import string
import urllib.parse as urlparse
# git history password storage
HOST = '0.0.0.0'
PORT = 7009

challenge_file = open('flag19.txt', 'r')  # open the file to read
challenge_data = challenge_file.readlines()  # stores a list of lines from the file

usernameANDpassword_file = open('usernameANDpassword.txt', 'r')
creds_data = usernameANDpassword_file.readlines()
creds_username = creds_data[0].strip()
creds_password = creds_data[1].strip()

log_file = open('git.log', 'r')
log_data = log_file.readlines()

# create an HTTP handler based on the existing BaseHTTPRequestHandler
class HTTPHandler(BaseHTTPRequestHandler):

    def do_GET(self):  # generate the status code for the GET request
        self.respond({'status': 200})

    def handle_http(self, status_code, path):  # handle the request
        self.send_response(status_code)
        self.send_header('Content-type', 'text/html')
        self.end_headers()

        output = ''

        # this will define how many lines of data the user can read from the file
        # read about GET parameters here: https://en.ryte.com/wiki/GET_Parameter
        get_params = urlparse.urlparse(path) # read the GET parameters from the URL that user requested
        # if the username and password match the ones in the creds_data, then show the secret information
        if 'username' in urlparse.parse_qs(get_params.query) and 'password' in urlparse.parse_qs(get_params.query):
            username = urlparse.parse_qs(get_params.query)['username'][0]
            password = urlparse.parse_qs(get_params.query)['password'][0]

            # do not allow the user to use the default admin/password credentials
            if creds_username == username and creds_password == password:
                # read the file and show it to the user if the credentials are correct
                for line in challenge_data:
                    output += line + '<br>'
            else:
                output = 'Wrong admin credentials!'
        # process git commands
        elif 'git' in urlparse.parse_qs(get_params.query):
            cmd = urlparse.parse_qs(get_params.query)['git'][0]
            # if the user requests viewing logs, show the logs
            if cmd == 'log':
                for line in log_data:
                    output += line + '<br>'
            # if the user requests to checkout a specific commit, allow to do that only if the hash is specified as well
            elif cmd == 'checkout' and 'hash' in urlparse.parse_qs(get_params.query):
                commit_hash = urlparse.parse_qs(get_params.query)['hash'][0]
                try:
                    commit_file = open('commits/' + commit_hash, 'r')  # open the file corresponding to that commit
                    commit_file_data = commit_file.readlines()  # stores a list of lines from the file
                    commit_file.close()
                    for line in commit_file_data:
                        output += line + '<br>'
                except:
                    output = 'File not found'

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
