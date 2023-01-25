<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Validator\Constraints as Assert;

class EmployeeCommand
{
    public const CREATE_GROUP = 'create';

    public const UPDATE_GROUP = 'update';

    #[Assert\NotBlank(groups: [self::CREATE_GROUP])]
    #[Assert\Length(max: 100, groups: [self::CREATE_GROUP, self::UPDATE_GROUP])]
    private ?string $name;

    #[Assert\NotBlank(groups: [self::CREATE_GROUP])]
    #[Assert\Length(max: 130, groups: [self::CREATE_GROUP, self::UPDATE_GROUP])]
    private ?string $surname;

    #[Assert\NotBlank(groups: [self::CREATE_GROUP])]
    #[Assert\Email(groups: [self::CREATE_GROUP, self::CREATE_GROUP])]
    #[Assert\Length(max: 255, groups: [self::CREATE_GROUP, self::UPDATE_GROUP])]
    private ?string $email;

    // TODO: #0000 - phoneNumber validation
    #[Assert\Length(max: 13, groups: [self::CREATE_GROUP, self::UPDATE_GROUP])]
    private ?string $phoneNumber;

    #[Assert\NotBlank(groups: [self::CREATE_GROUP, self::UPDATE_GROUP])]
    private ?array $company;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): EmployeeCommand
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): EmployeeCommand
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): EmployeeCommand
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): EmployeeCommand
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCompany(): ?array
    {
        return $this->company;
    }

    public function setCompany(?array $company): EmployeeCommand
    {
        $this->company = $company;
        return $this;
    }
}
