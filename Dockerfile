FROM ubuntu:20.04

RUN apt update
RUN DEBIAN_FRONTEND="noninteractive" apt-get -y install tzdata
RUN apt -y install php php-cli php-fpm php-json php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-pear php-bcmath
RUN apt -y install nginx

RUN apt-get update \
    && apt-get install -y mysql-server curl zip unzip git supervisor \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD default /etc/nginx/sites-available/

COPY ./site/ /var/www/html/

ARG MARIADB_MYSQL_SOCKET_DIRECTORY='/var/run/mysqld'

RUN mkdir -p $MARIADB_MYSQL_SOCKET_DIRECTORY && \
    chown root:mysql $MARIADB_MYSQL_SOCKET_DIRECTORY && \
    chmod 774 $MARIADB_MYSQL_SOCKET_DIRECTORY

ADD supervisord.conf /etc/supervisor/conf.d/supervisord.conf
ADD initial.sh /usr/bin/initial
RUN chmod +x /usr/bin/initial
RUN pkill -f nginx & wait $!

EXPOSE 80

ENTRYPOINT [ "initial" ]
