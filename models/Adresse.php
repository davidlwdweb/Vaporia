<?php

require_once './models/Model.php';

class Adresse extends Model {

    private int $userId;
    private string $label;
    private string $street;
    private string $number;
    private string $complements;
    private string $zipCode;
    private string $city;


    // GETTER and SETTER to $userId
    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
    
    
    // GETTER and SETTER to $getLabel
    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }
    
    

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getComplements()
    {
        return $this->complements;
    }

    public function setComplements($complements)
    {
        $this->complements = $complements;

        return $this;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }
}

?>