<?php 

require_once __DIR__ . '/vendor/autoload.php';

echo 'work';
session_start();
echo $_SESSION['user']->id();
echo $_POST['idPost'];

