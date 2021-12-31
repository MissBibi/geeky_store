<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_bia = "localhost";
$database_bia = "geeky_store";
$username_bia = "root";
$password_bia = "";
$bia = mysql_pconnect($hostname_bia, $username_bia, $password_bia) or trigger_error(mysql_error(),E_USER_ERROR); 
?>