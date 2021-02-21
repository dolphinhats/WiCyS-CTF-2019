from http.server import BaseHTTPRequestHandler, HTTPServer
import time
import re
import subprocess
import random
import string
import urllib.parse as urlparse

HOST = '0.0.0.0'
PORT = 7008

challenge_file = open('flag18.txt', 'r')  # open the file to read
challenge_data = challenge_file.readlines()  # stores a list of lines from the file

# you can learn more about regular expressions here https://regexr.com/
# this regular expression matches an string that start with an IP address
ip_regular_exp = re.compile('^([0-9]{1,3}\\.){3}[0-9]{1,3}')

# this variable stores the information for the IP address to ping and also the username
# and password of the administrator account, separated with a colon.
# first 15 characters are reserved for the IP address, then 5 more characters follow,
# after which administrator's username and password follow, separated with the colon.
# the total length will not exceed 256 characters
config_data = '255.255.255.255     admin:password'

# rewrite the username and password with the random data so that noone can access this server
config_data = '255.255.255.255     ' + ''.join(random.choices(string.ascii_lowercase + string.digits, k=16)) + ':' + ''.join(random.choices(string.ascii_lowercase + string.digits, k=16))

# create an HTTP handler based on the existing BaseHTTPRequestHandler
class HTTPHandler(BaseHTTPRequestHandler):

    def do_GET(self):  # generate the status code for the GET request
        self.respond({'status': 200})

    def handle_http(self, status_code, path):  # handle the request
        global config_data

        self.send_response(status_code)
        self.send_header('Content-type', 'text/html')
        self.end_headers()

        output = ''

        # this will define how many lines of data the user can read from the file
        # read about GET parameters here: https://en.ryte.com/wiki/GET_Parameter
        get_params = urlparse.urlparse(path) # read the GET parameters from the URL that user requested
        # if the username and password match the ones in the config_data, then show the secret information
        if 'username' in urlparse.parse_qs(get_params.query) and 'password' in urlparse.parse_qs(get_params.query):
            username = urlparse.parse_qs(get_params.query)['username'][0]
            password = urlparse.parse_qs(get_params.query)['password'][0]

            # do not allow the user to use the default admin/password credentials
            if (username + ':' + password) in config_data[20:] and username != 'admin' and password != 'password':
                # change the username and password as per our credentials rotation policy
                # to be honest, this is just to mess with the DevOps, they are gonna hate us
                config_data = '255.255.255.255     ' + ''.join(random.choices(string.ascii_lowercase + string.digits, k=16)) + ':' + ''.join(random.choices(string.ascii_lowercase + string.digits, k=16))

                # read the file and show it to the user if the credentials are correct
                for line in challenge_data:
                    output += line + '<br>'
            else:
                output = 'Wrong admin credentials!'
        elif 'ip' in urlparse.parse_qs(get_params.query):

            # get the IP address from the GET parameters
            ip = urlparse.parse_qs(get_params.query)['ip'][0]
            print('User entered: ' + ip)

            # make sure that we have a match on the IP address in the user input -> never trust the user!
            m = ip_regular_exp.match(ip)

            # run the command to ping the IP address
            # it is protected against command execution because it matches only IP address
            if m:
                # save the IP to config_data for us to know which IP was used last for pinging
                config_data = ip + ''.join([' ' for _ in range(20 - len(ip))]) + config_data[20:]

                # limit to 256 characters
                config_data = config_data[:256]
                # make sure that the IP starts with the pattern of an IP address
                
                ping_command = "ping " + m.group()
                # call a ping command but do not show the output
                subprocess.Popen(ping_command, stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True)
            else:
                output = 'You need to enter the IP address in its correct form, such as 1.1.1.1, which is actually the fastest privacy-preserving DNS in the world, just saying'


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
