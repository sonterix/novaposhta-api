<?php

// connect to DB
$dbHost = 'localhost';
$dbName = 'pineappletea100';
$dbUser = 'root';
$dbPass = '';
$dbChar = 'utf8';

$dsn = 'mysql:host='.$dbHost.';dbname='.$dbName.';charset='.$dbChar;
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => FALSE,
];
$dbh = new PDO($dsn, $dbUser, $dbPass, $opt);
