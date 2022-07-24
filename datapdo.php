<?php


$link = 'mysql:dbname=espace_membre2;host=localhost';
$pdo = new PDO( $link,'root','');

$pdo-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$pdo-> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);