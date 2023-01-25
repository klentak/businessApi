<?php

declare(strict_types=1);

namespace App\DTO\Company;

use JsonSerializable;

class CompanyDTO implements JsonSerializable
{
    private readonly int $id;
    private readonly string $name;
    private readonly string $nip;
    private readonly string $address;
    private readonly string $city;
    private readonly string $postCode;

    public function __construct(
        int $id,
        string $name,
        string $nip,
        string $address,
        string $city,
        string $postCode
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->nip = $nip;
        $this->address = $address;
        $this->city = $city;
        $this->postCode = $postCode;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNip(): string
    {
        return $this->nip;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPostCode(): string
    {
        return $this->postCode;
    }

    public function jsonSerialize(): mixed
    {
        return [
         'id' => $this->id,
         'name' => $this->name,
         'nip' => $this->nip,
         'address' => $this->address,
         'city' => $this->city,
         'postCode' => $this->postCode,
        ];
    }
}
