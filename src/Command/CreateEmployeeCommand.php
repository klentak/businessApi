<?php

declare(strict_types=1);

namespace App\Command;

use App\Arrayable;
use App\ToArrayTrait;

class CreateEmployeeCommand implements Arrayable
{
    use ToArrayTrait;

    private string $name;
    private string $surname;
    private string $email;
    private string $phoneNumber;
    private array $companies;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateEmployeeCommand
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): CreateEmployeeCommand
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): CreateEmployeeCommand
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): CreateEmployeeCommand
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCompanies(): ?array
    {
        return $this->companies;
    }

    public function setCompanies(?array $companies): CreateEmployeeCommand
    {
        $this->companies = $companies;

        return $this;
    }
}
