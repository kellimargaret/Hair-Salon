<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once 'src/Stylist.php';
    require_once 'src/Client.php';

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }
        function testSave()
        {
            //Arrange
            $id = null;
            $name = "Martha Stewart";
            $phone = "(888) 888-8888";
            $next_visit = "2015-09-06";
            $stylist_id = 1;
            $test_client = new Client($id, $name, $phone, $next_visit, $stylist_id);
            //Act
            $test_client->save();
            //Assert
            $result = Client::getAll();
            $this->assertEquals([$test_client], $result);
        }


    }
?>
