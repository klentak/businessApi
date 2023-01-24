<?php

declare(strict_types=1);

namespace App\DTO\Employee;

use JsonSerializable;

class EmployeeDTO implements JsonSerializable
{
    private readonly int $id;
    private readonly string $name;
    private readonly string $surname;
    private readonly string $email;
    private readonly string $phoneNumber;
    private readonly array $company;
    
    public function __construct(int $id, string $name, string $surname, string $email, string $phoneNumber, array $company)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->company = $company;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getCompany(): array
    {
        return $this->company;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'company' => $this->company,
        ];
    }
}
