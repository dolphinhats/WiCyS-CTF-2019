FROM python:3

WORKDIR "/src"

COPY . /src

RUN apt-get update && apt-get install -y curl

EXPOSE 7001/tcp

CMD [ "python", "./challenge11.py" ]
