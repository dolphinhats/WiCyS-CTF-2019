import re
import os
import random
import string
import sys
import getopt
import argparse
from collections import OrderedDict


def create_flag(seed):
    letters = string.ascii_letters
    digits = string.digits
    key = letters + digits
    flag = []
    random.seed(seed)
    for _ in range(36):
        flag.append(random.choice(key))
    return ''.join(flag)


def replace_flags(filename, seed):
    with open(filename) as f:
        s = f.read()
        match = re.search('flag{.*}', s)
        if not match:
            return False
    flag = create_flag(seed)
    with open(filename, 'w') as f:
        s = re.sub('flag\{.*\}', 'flag{' + flag + '}', s)
        f.write(s)
        return True


def randomize_flags():
    s = set()
    l = []
    for directory in os.listdir('.'):
        seed = random.randrange(0, 43134)
        while seed in s:
            seed = random.randrange(0, 43134)
        s.add(seed)
        if os.path.isdir(directory):
            for root, _, filename in os.walk(os.path.join('.', directory)):
                for file in filename:
                    file = os.path.join(root, file)
                    if file.endswith(('py', 'h', 'php', 'java', 'txt', 'yml')):
                        outcome = replace_flags(file, seed)
                        if outcome:
                            if seed not in l:
                                l.append(seed)
    return l


def restore_flags(pre_generated):
    i = 0
    found = 1
    for directory in os.listdir('.'):
        if found:
            if i + 1 <= len(pre_generated):
                seed = pre_generated[i]
            i += 1
            found = 0

        if os.path.isdir(directory):
            for root, _, filename in os.walk(os.path.join('.', directory)):
                for file in filename:
                    file = os.path.join(root, file)
                    if file.endswith(('py', 'h', 'php', 'java', 'txt', 'yml')):
                        output = replace_flags(file, seed)
                        if output:
                            found = 1


if __name__ == '__main__':
    parser = argparse.ArgumentParser()
    parser.add_argument('-s', '--seeds')
    args = parser.parse_args()
    if args.seeds:
        restore_flags(list(map(int, args.seeds.split(', '))))
    else:
        print(randomize_flags())
