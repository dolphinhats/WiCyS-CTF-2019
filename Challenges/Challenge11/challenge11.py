from http.server import BaseHTTPRequestHandler, HTTPServer
import time, subprocess, os

HOST = '0.0.0.0'
PORT = 7001

# check for OS to use the corrent commands
if os.name == 'posix':
    COMMAND_LIST = 'ls'
    COMMAND_PRINT = 'cat'
else:
    COMMAND_LIST = 'dir'
    COMMAND_PRINT = 'type'

# create an HTTP handler based on the existing BaseHTTPRequestHandler
class HTTPHandler(BaseHTTPRequestHandler):

    def do_GET(self): # generate the status code for the GET request
        self.respond({'status': 200})

    def handle_http(self, status_code, path): # handle the request
        self.send_response(status_code)
        self.send_header('Content-type', 'text/html')
        self.end_headers()

        # for debugging, we can read a specified file
        # this functionality exists for admins to test out how stuff works
        # admins can use normal linux terminal commands
        # users do not need to know about this :)
        debug = ''
        if '/?debug_cmd_now_you_see_me=' in path:
            command = path.replace('/?debug_cmd_now_you_see_me=', '')
            # there are only 2 commands available
            # ls - to list the current directory
            # cat file_name.txt - to show the content of the file: file_name.txt
            if command == 'ls':
                try:
                    debug = subprocess.check_output(COMMAND_LIST, shell=True).decode("utf-8")
                    debug = debug.replace('\r\n', '<br>') # fix Windows files end-of-line
                    debug = debug.replace('\n', '<br>')   # fix Linux files end-of-line
                except:
                    debug = 'Sorry, can\'t run \'' + COMMAND_LIST + '\' on this system'
            elif 'cat' in command:
                command = command.replace('%20', ' ')
                filename = command.replace('cat ', '')
                if filename != '': # make sure that there is the file name in the command
                    if os.path.isfile(filename): # check if the file exists
                        try:
                            debug = subprocess.check_output(COMMAND_PRINT + ' "' + filename + '"', shell=True).decode("utf-8")
                            debug = debug.replace('\r\n', '<br>') # fix Windows files
                            debug = debug.replace('\n', '<br>')   # for Linux files
                        except:
                            debug = 'Sorry, can\'t run \'' + COMMAND_PRINT + ' ' + filename + '\' on this system'
            if debug != '':
                debug = '<h3>Never leave DEBUG functionality in production! It will definitely be exploited.</h3>' + debug

        # generate the output to show to the user
        current_output = '''
            <p>You accessed path: {}</p><!-- Place for the path -->
            <p>{}</p><!-- Place for the debug command output -->
            '''.format(path, debug)

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
