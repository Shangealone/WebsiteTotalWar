<?php
$dbc = @mysqli_connect('localhost', 'root', '', 'members_shangealone') 
OR die('Could not connect to MySQL Server: ' . mysqli_connect_error());

mysqli_set_charset($dbc, 'utf8');