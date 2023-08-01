#!/bin/bash

# Iniciar o Apache
/usr/sbin/apache2ctl -D FOREGROUND &

# Iniciar o serviço do MySQL
service mysql start

sleep 5

mysql -uroot -e "CREATE DATABASE IF NOT EXISTS saude CHARACTER SET latin1 COLLATE latin1_swedish_ci;"
mysql -uroot saude < /var/lib/mysql/saude.sql

# Mantenha o script em execução para que o contêiner não saia imediatamente
tail -f /dev/null