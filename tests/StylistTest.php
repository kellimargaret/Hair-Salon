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

        function testFind()
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
            $result = Stylist::find($test_stylist->getId());
            //Assert
            $this->assertEquals($test_stylist, $result);
        }

        function testUpdate()
        {
            //Arrange
            $id = null;
            $name = "Mariann";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();
            $new_name = "Ashley";
            //Act
            $test_stylist->update($new_name);
            //Assert
            $result = $test_stylist->getName();
            $this->assertEquals($new_name, $result);
        }

        function testDelete()
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
            $test_stylist->delete();
            //Assert
            $result = Stylist::getAll();
            $this->assertEquals([$test_stylist2], $result);
        }

        function testGetClients()
        {
            //Arrange
            $id = null;
            $name = "Mariann";
            $test_stylist = new Stylist($id, $name);
            $test_stylist->save();
            $test_stylist_id = $test_stylist->getId();
            $client_name = "Mario";
            $phone = "(570) 428-2910";
            $next_visit = "2015-08-10";
            $test_client = new Client($id, $client_name, $phone, $next_visit, $test_stylist_id);
            $test_client->save();
            $client_name2 = "Maria";
            $phone2 = "(574) 444-2910";
            $next_visit2 = "2015-08-15";
            $test_client2 = new Client($id, $client_name2, $phone2, $next_visit2, $test_stylist_id);
            $test_client2->save();
            //Act
            $result = $test_stylist->getClients();
            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

    }
?>
