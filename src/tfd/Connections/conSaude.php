<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conSaude = "localhost";
$database_conSaude = "saude";
$username_conSaude = "root";
$password_conSaude = "";
$conSaude = mysql_pconnect($hostname_conSaude, $username_conSaude, $password_conSaude) or die(mysql_error());
?>
