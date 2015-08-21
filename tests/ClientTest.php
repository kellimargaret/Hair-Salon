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

        //Test Save function
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

        //Test function to get all client information
        function testGetAll()
        {
            //Arrange
            $id = null;
            $name = "Martha Stewart";
            $phone = "(888) 888-8888";
            $next_visit = "2015-09-06";
            $stylist_id = 1;
            $test_client = new Client($id, $name, $phone, $next_visit, $stylist_id);
            $test_client->save();

            $name2 = "Jennifer Lopez";
            $phone2 = "(609) 999-9999";
            $next_visit2 = "2015-10-12";
            $stylist_id2 = 2;
            $test_client2 = new Client($id, $name2, $phone2, $next_visit2, $stylist_id2);
            $test_client2->save();
            //Act
            $result = Client::getAll();
            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        //Test function to delete all clients
        function testDeleteAll()
        {
            //Arrange
            $id = null;
            $name = "Martha Stewart";
            $phone = "(888) 888-8888";
            $next_visit = "2015-09-06";
            $stylist_id = 1;
            $test_client = new Client($id, $name, $phone, $next_visit, $stylist_id);
            $test_client->save();

            $name2 = "Jennifer Lopez";
            $phone2 = "(609) 999-9999";
            $next_visit2 = "2015-10-12";
            $stylist_id2 = 2;
            $test_client2 = new Client($id, $name2, $phone2, $next_visit2, $stylist_id2);
            $test_client2->save();
            //Act
            Client::deleteAll();
            //Assert
            $result = Client::getAll();
            $this->assertEquals([], $result);
        }

        //Test function to find client in list
        function testFind()
        {
            //Arrange
            $id = null;
            $name = "Martha Stewart";
            $phone = "(888) 888-8888";
            $next_visit = "2015-09-06";
            $stylist_id = 1;
            $test_client = new Client($id, $name, $phone, $next_visit, $stylist_id);
            $test_client->save();

            $name2 = "Jennifer Lopez";
            $phone2 = "(609) 999-9999";
            $next_visit2 = "2015-10-12";
            $stylist_id2 = 2;
            $test_client2 = new Client($id, $name2, $phone2, $next_visit2, $stylist_id2);
            $test_client2->save();
            //Act
            $result = Client::find($test_client->getId());
            //Assert
            $this->assertEquals($test_client, $result);
        }

        //Test function to update client name
        function testUpdateName()
        {
            //Arrange
            $id = null;
            $name = "Martha Stewart";
            $phone = "(888) 888-8888";
            $next_visit = "2015-09-06";
            $stylist_id = 1;
            $test_client = new Client($id, $name, $phone, $next_visit, $stylist_id);
            $test_client->save();


            $new_name = "Katie Curic";
            $name = 'name';
            //Act
            $test_client->update($name, $new_name);
            //Assert
            $clients = Client::getAll();
            $result = $clients[0]->getName();
            $this->assertEquals($new_name, $result);
        }

        //Test function to delete client
        function testDelete()
        {
            //Arrange
            $id = null;
            $name = "Martha Stewart";
            $phone = "(888) 888-8888";
            $next_visit = "2015-09-06";
            $stylist_id = 1;
            $test_client = new Client($id, $name, $phone, $next_visit, $stylist_id);
            $test_client->save();


            $name2 = "Jennifer Lopez";
            $phone2 = "(609) 999-9999";
            $next_visit2 = "2015-10-12";
            $stylist_id2 = 2;
            $test_client2 = new Client($id, $name2, $phone2, $next_visit2, $stylist_id2);
            $test_client2->save();
            //Act
            $test_client->delete();
            //Assert
            $result = Client::getAll();
            $this->assertEquals([$test_client2], $result);
        }


    }
?>
