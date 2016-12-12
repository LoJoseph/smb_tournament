<?php
// connexion à la bdd
$DSN = 'mysql:host=localhost;dbname=super_smash_bros';
$user =  'root';
$mdp = '';
$options = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
];

$draft = NEW PDO($DSN,$user,$mdp,$options);


