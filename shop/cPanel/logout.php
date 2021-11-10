<?php

session_start();

if(isset($_SESSION['Aname']))
{
	unset($_SESSION['Aname']);

}

header("Location: login.php");