<?php

class Stylist
    {
        private $id;
        private $stylist_name;

        function __construct($id = null, $stylist_name)
        {
            $this->id = $id;
            $this->stylist_name = $stylist_name;
        }
        //Getters and setters
        function getId()
        {
            return $this->id;
        }
        function getStylistName()
        {
            return $this->stylist_name;
        }
        function setStylistName($new_stylist_name)
        {
            $this->stylist_name = $new_stylist_name;
        }
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylists (stylist_name) VALUES ('{$this->getStylistName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists");
            $stylists = array();
            foreach($returned_stylists as $stylist) {
                $id = $stylist['id'];
                $stylist_name = $stylist['stylist_name'];
                $new_stylist = new Stylist($id, $stylist_name);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists");
        }
        static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist) {
                $stylist_id = $stylist->getId();
                if ($stylist_id == $search_id) {
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }
        function update($new_stylist_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylist SET name = '{$new_stylist_name}' WHERE id = {$this->getId()};");
            $this->setStylistName($new_stylist_name);
        }
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
        }
        function getClients()
        {
            $clients = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
            foreach ($returned_clients as $client) {
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
    }
?>
