<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
require_once "src/Client.php";
require_once "src/Stylist.php";

$server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);


    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function testGetName()
        {
            //Arrange
            $id = null;
            $name = "Pixie";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();
            //Act
            $result = $test_stylist->getName();
            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $id = null;
            $name = "Star";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();
            //Act
            $new_name = "Ashley";
            $test_stylist->setName($new_name);
            //Assert
            $result = $test_stylist->getName();
            $this->assertEquals($new_name, $result);
        }

        function testSave()
        {
            //Arrange
            $id = null;
            $name = "Journey";
            $test_stylist = new Stylist($id, $name);
            //Act
            $test_stylist->save();
            //Assert
            $result = Stylist::getAll();
            $this->assertEquals([$test_stylist], $result);
        }

        function testGetAll()
        {
            //Arrange
            $id = null;
            $name = "Kourtney";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();
            $name2 = "Xavier";
            $test_stylist2 = new Stylist($id, $name2);
            $test_stylist2->save();
            //Act
            $result = Stylist::getAll();
            //Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $id = null;
            $name = "Mariann";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();
            $name2 = "Mario";
            $test_stylist2 = new Stylist($id, $name2);
            $test_stylist2->save();
            //Act
            Stylist::deleteAll();
            //Assert
            $result = Stylist::getAll();
            $this->assertEquals([], $result);
        }

    }
?>
