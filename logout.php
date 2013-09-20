<?php
require_once("starter.php");
$user->logout();
header("Location: login.php");
?>