<?php
require '../vendor/autoload.php'; 

define('VIEWS', dirname(__DIR__). DIRECTORY_SEPARATOR. 'view'. DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']). DIRECTORY_SEPARATOR);

define('DB_NAME', 'Base_car');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');

require '../routes/web.php';



