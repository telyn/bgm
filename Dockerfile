FROM debian:buster

RUN apt update \
 && apt install -y zsh mpg123 \
 && mkdir -p /var/lib/bgm/playlists /var/run/bgm \
 && mkdir -p /var/run/bgm/queue \
 && touch /var/run/bgm/queue

COPY bgm /usr/bin/bgm
VOLUME /music
VOLUME /var/lib/bgm/playlists

CMD [ '/usr/bin/bgm', 'start' ]
