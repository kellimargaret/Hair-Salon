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
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE client_id = {$this->getId()};");
            array_push($clients, $new_clients);
        }

        return $clients;
    }

?>
