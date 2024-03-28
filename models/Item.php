<?php

require_once './models/Model.php';

class Item extends Model {

    private string $title;
    private string $description;
    private string $price;
    private int $quantity;
    private string|null $power;
    private string|null $capacity;
    private int $makerId;
    private string $origin;
    private string|null $battery;
    private DateTime $dateAdd;
    private DateTime $dateModification;
    private int $available;
    private int $categorieId;
    private ?string $picture;
    private string $caption;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPower()
    {
        return $this->power;
    }

    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getMakerId()
    {
        return $this->makerId;
    }

    public function setMakerId($makerId)
    {
        $this->makerId = $makerId;

        return $this;
    }

    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    public function getBattery()
    {
        return $this->battery;
    }

    public function setBattery($battery)
    {
        $this->battery = $battery;

        return $this;
    }

    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    public function getDateModification()
    {
        return $this->dateModification;
    }

    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    public function getAvailable()
    {
        return $this->available;
    }

    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    public function getCategorieId()
    {
        return $this->categorieId;
    }

    public function setCategorieId($categorieId)
    {
        $this->categorieId = $categorieId;

        return $this;
    }
    
    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture(?string $picture)
    {
        $this->picture = $picture;

        return $this;
    }
    
    public function getCaption()
    {
        return $this->caption;
    }

    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }
}







?>