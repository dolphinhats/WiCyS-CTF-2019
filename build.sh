#!/bin/bash

###
# Variables

secretKeyFile=.ctfd_secret_key

###
# Setup and configure CTFd https://github.com/CTFd/CTFd/

git clone https://github.com/CTFd/CTFd.git ctfd

cd ctfd

head -c 64 /dev/urandom > $secretKeyFile

cd ..

docker-compose up

