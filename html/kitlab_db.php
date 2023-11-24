<?php
$database = 'ete32e_2324zs_11';
$username = 'ete32e_2324zs_11';
$password = '151s108T09A!32';
$mysqli = new mysqli('localhost',$username,$password,$database);
if ($mysqli->connect_errno) { echo 'Failed to connect to MySQL: '.$mysqli->connect_error; exit(); } else { echo 'Connection to DB is OK.'; }
