<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "shop";

if(!$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("Det fick inte att ansluta till databas");
}