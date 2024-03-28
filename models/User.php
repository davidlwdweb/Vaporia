<?php

require_once './models/Model.php';

class User extends Model {

    private string $email;
    private string $password;
    private string $firstname;
    private string $lastname;
    private DateTime $dateRegistration;
    private DateTime $dateModification;
    private DateTime $birthdate;
    private int $rank;


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDateRegistration()
    {
        return $this->dateRegistration;
    }

    public function setDateRegistration($dateRegistration)
    {
        $this->dateRegistration = $dateRegistration;

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

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }
    
    public function getRank()
    {
        return $this->rank;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }
    
    
    
    
}







?>