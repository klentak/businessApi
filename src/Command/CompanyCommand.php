<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Validator\Constraints as Assert;

class CompanyCommand
{
    public const CREATE_GROUP = 'create';
    public const UPDATE_GROUP = 'update';

    #[Assert\NotBlank(groups: [self::CREATE_GROUP])]
    #[Assert\Length(max: 255, groups: [self::CREATE_GROUP, self::UPDATE_GROUP])]
    private  ?string $name;

    #[Assert\NotBlank(groups: [self::CREATE_GROUP])]
    #[Assert\Length(min: 10, max: 10, groups: [self::CREATE_GROUP, self::UPDATE_GROUP])]
    private  ?string $nip;

    #[Assert\NotBlank(groups: [self::CREATE_GROUP])]
    #[Assert\Length(max: 255, groups: [self::CREATE_GROUP, self::UPDATE_GROUP])]
    private  ?string $address;

    #[Assert\NotBlank(groups: [self::CREATE_GROUP])]
    #[Assert\Length(max: 70, groups: [self::CREATE_GROUP, self::UPDATE_GROUP])]
    private  ?string $city;

    #[Assert\NotBlank(groups: [self::CREATE_GROUP])]
    #[Assert\Length(max: 11, groups: [self::CREATE_GROUP, self::UPDATE_GROUP])]
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
