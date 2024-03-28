<?php

require_once './models/Model.php';

class Maker extends Model {

    private string $maker;


    public function getMaker()
    {
        return $this->maker;
    }

    public function setMaker($maker)
    {
        $this->maker = $maker;

        return $this;
    }
}

?>