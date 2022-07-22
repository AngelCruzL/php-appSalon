<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'functions.php';
require 'database.php';

use Model\ActiveRecord;

ActiveRecord::setDB($db);
