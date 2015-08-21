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
    function getNextVisit()
    {
        return $this->next_visit;
    }

?>
