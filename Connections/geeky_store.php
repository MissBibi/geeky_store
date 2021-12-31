<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_geeky_store = "localhost";
$database_geeky_store = "geeky_store";
$username_geeky_store = "root";
$password_geeky_store = "";
$geeky_store = mysql_pconnect($hostname_geeky_store, $username_geeky_store, $password_geeky_store) or trigger_error(mysql_error(),E_USER_ERROR); 
?>