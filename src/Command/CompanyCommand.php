<?php

declare(strict_types=1);

namespace App\Command;

class CompanyCommand
{
    private  ?string $name;

    private  ?string $nip;

    private  ?string $address;

    private  ?string $city;

    private  ?string $postCode;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): CompanyCommand
    {
        $this->name = $name;

        return $this;
    }

    public function getNip(): ?string
    {
        return $this->nip;
    }

    public function setNip(?string $nip): CompanyCommand
    {
        $this->nip = $nip;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): CompanyCommand
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): CompanyCommand
    {
        $this->city = $city;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): CompanyCommand
    {
        $this->postCode = $postCode;

        return $this;
    }
}
