<?php

declare(strict_types=1);

namespace App\Command;

class CreateCompanyCommand
{
    private  string $name;
    private  string $nip;
    private  string $address;
    private  string $city;
    private  string $postCode;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateCompanyCommand
    {
        $this->name = $name;

        return $this;
    }

    public function getNip(): string
    {
        return $this->nip;
    }

    public function setNip(string $nip): CreateCompanyCommand
    {
        $this->nip = $nip;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): CreateCompanyCommand
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): CreateCompanyCommand
    {
        $this->city = $city;

        return $this;
    }

    public function getPostCode(): string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): CreateCompanyCommand
    {
        $this->postCode = $postCode;

        return $this;
    }
}
