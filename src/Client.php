<?php

    class Client
    {
    private $name;
    private $stylist_id;
    private $id;
    private $phone;
    private $next_visit;

    //Constructors
    function __construct($name, $stylist_id, $phone, $next_visit, $id = null)
    {
        $this->client_name = $name;
        $this->stylist_id = $stylist_id;
        $this->phone = $phone
        $this->next_visit = $next_visit;
        $this->id = $id;
    }
    //Setters
    function setClientName($new_client)
    {
        $this->name = (string) $new_client;
    }

    function setStylistId($new_stylist_id)
    {
        $this->stylist_id = (string) $new_stylist_id;
    }

    function setPhone($new_phone)
    {
        $this->phone = (string) $new_phone;
    }

    function getNextVisit($new_visit)
    {
        $this->next_visit = $new_visit;
    }

    //Getters
    function getClientName()
    {
        return $this->name;
    }

    function getId()
    {
      return $this->id;
    }

    function getStylistId()
    {
        return $this->stylist_id;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function getNextVisit()
    {
        return $this->next_visit;
    }

    //Save function
    function save()
    {
      $GLOBALS['DB']->exec("INSERT INTO client (name, stylist_id, phone, next_visit) VALUES ('{$this->getClientName()}', {$this->getStylistId()}, '{$this->getPhone()}', '{$this->getNextVisit()}');");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }
    //Get All function
    static function getAll()
    {
        $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM client ORDER BY next_visit;");
        $tasks = array();
        foreach($returned_client as $client) {
          $name = $name['name'];
          $id = $client['id'];
          $stylist_id = $client['stylist_id'];
          $new_client = new Client($name, $stylist_id, $phone, $next_visit, $id);
          array_push($clients, $new_client);
        }
        return $clients;
    }
    //Delete ALl function
    static function deleteAll()
    {
      $GLOBALS ['DB']->exec("DELETE FROM clients;");
    }
    //Find function
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

?>
