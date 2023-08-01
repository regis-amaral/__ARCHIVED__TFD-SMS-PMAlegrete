FROM scratch

ENV DEBIAN_FRONTEND=noninteractive

ADD conf/ubuntu-8.10-root.tar.xz /
COPY conf/sources.list /etc/apt/sources.list
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -yq --no-install-recommends \
    curl php5 php5-common php5-curl php5-cli php5-gd php5-imap php5-mcrypt php5-mysql mysql-server nano

COPY conf/start.sh /etc/init.d/start.sh
RUN chmod +x /etc/init.d/start.sh

COPY conf/data/saude.sql /var/lib/mysql/saude.sql

COPY conf/default /etc/apache2/sites-available/default

COPY src/ /var/www/

WORKDIR /var/www/

RUN a2enmod rewrite

EXPOSE 80

CMD /etc/init.d/start.sh


