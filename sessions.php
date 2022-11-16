<?php

// sessions()
session_start();

$_SESSION['username'] = "prashant";
$_SESSION['password'] = "ekart";
$_SESSION['email'] = "ekart@gmail.com";
echo "Session data is saved";

?>