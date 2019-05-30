<?php
require './bootstrap.php';
session_destroy();
header('location: index.php');
exit;
