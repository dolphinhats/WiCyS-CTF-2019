from http.server import BaseHTTPRequestHandler, HTTPServer
import time
import re
import subprocess
import random
import string
import urllib.parse as urlparse

HOST = '0.0.0.0'
PORT = 7010

challenge_file = open('flag20.txt', 'r')  # open the file to read
challenge_data = challenge_file.readlines()  # stores a list of lines from the file

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
        # if the username and language are passed in GET parameters, then save that to a file
        if 'username' in urlparse.parse_qs(get_params.query) and 'language' in urlparse.parse_qs(get_params.query):
            username = urlparse.parse_qs(get_params.query)['username'][0]
            language = urlparse.parse_qs(get_params.query)['language'][0]

            print(username + ' ' + language)

            # run the native Linux command, given user's input of the username and language
            # basically saves the language request in a file with the username
            cmd = 'echo {} > ./languages/{}.txt'.format(language, username)

            subprocess.Popen(cmd, shell=True, stdout=subprocess.PIPE, stderr=subprocess.STDOUT)
            
            output = 'The data has been saved to the file and you can rest assured that your language shall be spoken!'
        elif path == '/LICENSE.md':
            license_file = open('LICENSE.md', 'r')
            license_data = license_file.readlines()
            license_file.close()
            for line in license_data:
                output += line.replace('\n', '<br>')
            # update the license file just in case
            license_file = open('LICENSE.md', 'w')
            license_file.write('''# License Agreement

If this software causes you to go bananas, accidentally destroys all your data on your laptop, changes all your messages to memes, encrypts your personal information and publishes it online, makes you wake up at 5 am on Sunday morning and exercise, calls all people on your contact list every hour, memefies your life (if it's even a word) calls Microsoft Helpdesk for no valid reason, makes fun of you in your sleep, shocks you if you don't pay attention in class, and frantically starts doing a filibuster speech -- don't blame Russians, blame their subconscious mind.
            ''')
            license_file.close()
        else:
            output = 'Freedom to changing your language without barriers!'

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
