<?php

declare(strict_types=1);

namespace App\Command;

use App\Arrayable;
use App\ToArrayTrait;

class UpdateCompanyCommand implements Arrayable
{
    use ToArrayTrait;

    private  int $id;
    private  ?string $name;
    private  ?string $nip;
    private  ?string $address;
    private  ?string $city;
    private  ?string $postCode;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): UpdateCompanyCommand
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): UpdateCompanyCommand
    {
        $this->name = $name;

        return $this;
    }

    public function getNip(): ?string
    {
        return $this->nip;
    }

    public function setNip(?string $nip): UpdateCompanyCommand
    {
        $this->nip = $nip;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): UpdateCompanyCommand
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): UpdateCompanyCommand
    {
        $this->city = $city;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): UpdateCompanyCommand
    {
        $this->postCode = $postCode;

        return $this;
    }
}
