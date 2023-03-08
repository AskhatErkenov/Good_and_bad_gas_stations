<?php
$hostname = 'localhost';
$userna = 'root';
$passwor = '';
$database = 'gas_stations';
$connect = mysqli_connect($hostname, $userna, $passwor, $database);
if ($connect->connect_errno) exit('Ошибка подключения к БД');

?>