from collections import defaultdict
import os
import re
import threading
import yaml
import json
import argparse

# Initialize ctfcli with the CTFD_TOKEN and CTFD_URL.


def init():
    CTFD_TOKEN = os.getenv("CTFD_TOKEN", default=None)
    CTFD_URL = os.getenv("CTFD_URL", default=None)

    if not CTFD_TOKEN or not CTFD_URL:
        exit(1)

    os.system(f"echo '{CTFD_URL}\n{CTFD_TOKEN}\ny' | ctf init")


def find_challenges(order):
    d = defaultdict(list)
    challenges = [file for file in os.listdir('.') if os.path.isdir(file)]
    for challenge in challenges:
        if os.path.exists(f'{challenge}/challenge.yml'):
            with open(f'{challenge}/challenge.yml') as f:
                data = yaml.load(f, Loader=yaml.FullLoader)
                d[data['category']].append(challenge)
    return d


def sync(challenges_dict, order):
    for category in order:
        for challenge in challenges_dict[category]:
            print(f'Syncing challenge: {challenge}')
            os.system(
                f'ctf challenge sync {challenge}; ctf challenge install {challenge}')


def change_state(waves, state, challenges_dict):
    if state not in ('visible', 'hidden'):
        raise Exception("state must be 'visible' or 'hidden'")
    for wave in waves:
        for challenge in challenges_dict[wave]:
            print(f'changing {challenge}')
            with open(f'{challenge}/challenge.yml') as f:
                data = yaml.load(f, Loader=yaml.FullLoader)
                data['state'] = state
            with open(f'{challenge}/challenge.yml', 'w') as f:
                yaml.dump(data, f, sort_keys=False)


def firewall(visible, hidden):
    pass


def main():
    state = ''
    wave = []
    firewall = False
    parser = argparse.ArgumentParser()
    parser.add_argument(
        '-w', '--week', help='list weeks to work with. e.g. to work with all 4 weeks "1 2 3 4"')
    parser.add_argument(
        '-r', '--hide', help='select to hide challenges', action='store_true')
    parser.add_argument(
        '-s', '--show', help='select to show challenges', action='store_true')
    parser.add_argument(
        '-f', '--firewall', help='changes firewall settings for selected challenges')
    args = parser.parse_args()
    if args.week:
        temp = args.week.split()
        for n in temp:
            wave.append('Week ' + n)

    if args.hide:
        state = 'hidden'
    elif args.show:
        state = 'visible'

    if args.firewall:
        firewall = True

    order = ['Week 1', 'Week 2', 'Week 3', 'Week 4']
    challenges = find_challenges(order)
    init()
    change_state(wave, state, challenges)
    sync(challenges, order)


if __name__ == '__main__':
    main()
