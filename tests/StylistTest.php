<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
require_once "src/Client.php";
require_once "src/Stylist.php";
$server = 'mysql:host=localhost:8888;dbname=hair_salon';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class StylistTest extends PHPUnit_Framework_TestCase
{

}

?>
