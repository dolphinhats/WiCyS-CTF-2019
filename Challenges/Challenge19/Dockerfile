FROM python:3

WORKDIR "/src"

COPY . /src

RUN apt-get update && apt-get install -y curl

EXPOSE 7009/tcp

CMD [ "python", "./challenge19.py" ]
