<?php

class Client
    {
        private $id;
        private $client_name;
        private $phone;
        private $stylist_id;
        private $next_visit;



        //Constructor
        function __construct($id = null, $client_name, $phone, $next_visit, $stylist_id)
        {
            $this->id = $id;
            $this->client_name = $client_name;
            $this->phone = $phone;
            $this->next_visit = $next_visit;
            $this->stylist_id = $stylist_id;
        }

        //Getters
        function getId()
        {
            return $this->id;
        }

        function getClientName()
        {
            return $this->client_name;
        }

        function getPhone()
        {
            return $this->phone;
        }

        function getNextVisit()
        {
            return $this->next_visit;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }

        //Setters
        function setClientName($new_client_name)
        {
            $this->client_name = $new_client_name;
        }

        function setPhone($new_phone)
        {
            $this->phone = $new_phone;
        }

        function setNextVisit($new_next_visit)
        {
            $this->next_visit = $new_next_visit;
        }

        function setStylistId($new_stylist_id)
        {
            $this->stylist_id = $new_stylist_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (client_name, phone, next_visit, stylist_id) VALUES ('{$this->getClientName()}', '{$this->getPhone()}', '{$this->getNextVisit()}', {$this->getStylistId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients");
            $clients = array();
            foreach($returned_clients as $client) {
                $id = $client['id'];
                $client_name = $client['client_name'];
                $phone = $client['phone'];
                $next_visit = $client['next_visit'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($id, $client_name, $phone, $next_visit, $stylist_id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        static function find($search_id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach($clients as $client) {
                $client_id = $client->getId();
                if ($client_id == $search_id) {
                    $found_client = $client;
                }
            }
            return $found_client;
        }

        function update($field, $new_value)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET {$field} = '{$new_value}' WHERE id = {$this->getId()};");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
        }
    }

?>
