<?php

namespace App\Core\Entity;

class User
{
    private int $id;
    private string $firstName;
    private string $lastName;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
