FROM regisamaral/ubuntu:intrepid

COPY conf/start.sh /etc/init.d/start.sh
RUN chmod +x /etc/init.d/start.sh

COPY conf/data/saude.sql /var/lib/mysql/saude.sql

COPY conf/default /etc/apache2/sites-available/default

COPY src/ /var/www/

WORKDIR /var/www/

RUN a2enmod rewrite

EXPOSE 80

CMD /etc/init.d/start.sh


