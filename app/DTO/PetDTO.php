<?php

namespace App\DTO;

class PetDTO
{
    public $id;
    public $name;
    public $status;

    public function __construct(array $pet)
    {
        $this->id = $pet['id'];
        $this->name = $pet['name'];
        $this->status = $pet['status'];
    }
}
