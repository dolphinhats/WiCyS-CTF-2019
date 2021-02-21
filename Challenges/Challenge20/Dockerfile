FROM python:3

WORKDIR "/src"

COPY . /src

RUN apt-get update && apt-get install -y curl

RUN chmod -R 755 /src \
&& chmod 777 LICENSE.md \
&& chmod -R 000 /tmp \
&& useradd ctf_warrior


EXPOSE 7010/tcp

USER ctf_warrior

CMD [ "python", "./challenge20.py" ]
