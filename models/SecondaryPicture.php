<?php

require_once './models/Model.php';

class SecondaryPicture extends Model {

    private int $itemsId;
    private string $picture;
    private string $caption;


    public function getItemsId(): ?int {
        return $this->itemsId;
    }

    public function setItemsId($itemsId): ?int{
        $this->itemsId = $itemsId;

        return $this;
    }

    public function getPicture(): ?string{
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCaption()
    {
        return $this->caption;
    }

    public function setCaption($caption): self
    {
        $this->caption = $caption;

        return $this;
    }
}

?>