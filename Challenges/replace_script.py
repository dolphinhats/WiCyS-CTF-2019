import os


def change_file(filename, old_string, new_string):
    with open(filename) as f:
        s = f.read()
        if old_string not in s:
            print(f'The string is not found in {filename}')
            return

    with open(filename, 'w') as f:
        s = s.replace(old_string, new_string)
        f.write(s)


def main(old_string, new_string, file_start):
    for root, _, filenames in os.walk('.'):
        for file in filenames:
            if file.startswith(file_start):
                filepath = os.path.join(root, file)
                change_file(filepath, old_string, new_string)


if __name__ == "__main__":
    try:
        with open('replace_file.txt') as f:
            while True:
                old_string = f.readline()
                new_string = f.readline()
                if not new_string or not old_string:
                    break
                main(old_string.strip(), new_string.strip(), 'index')

    except KeyboardInterrupt:
        print('Thank you for your service: ')
