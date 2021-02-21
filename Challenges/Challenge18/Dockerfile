FROM python:3

WORKDIR "/src"

COPY . /src

RUN apt-get update && apt-get install -y curl

EXPOSE 7008/tcp

CMD [ "python", "./challenge18.py" ]
