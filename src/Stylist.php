<?php

    class Stylist
    {
        private $name;
        private $id;

        //Constructors
        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        //Setters
        function setStylistName ($new_name)
        {
            $this->name = (string) $new_name;
        }

        //Getters
        function getStylistName()
        {
            return $this->name;
        }

        function getClients()
        {
            $clients = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()} ORDER BY next_visit;");
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $next_visit = $client['next_visit'];
                $id = $task['id'];
                $new_client= new Client($name, $stylist_id, $next_visit, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        function getId()
        {
            return $this->id;
        }

        //Save function
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylsits (name) VALUES ('{$this->getStylistName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }
        //Static functions
        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $stylist) {
                $name = $stylists['name'];
                $new_stylist = new Stylist($name, $id);
                $id = $stylist['id'];
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
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
    }


?>
