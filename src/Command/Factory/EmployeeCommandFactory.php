<?php

declare(strict_types=1);

namespace App\Command\Factory;

use App\Command\EmployeeCommand;

class EmployeeCommandFactory
{
    public static function createFromPayload(array $payload): EmployeeCommand
    {
        return (new EmployeeCommand())
            ->setName($payload['name'] ?? null)
            ->setSurname($payload['surname'] ?? null)
            ->setEmail($payload['email'] ?? null)
            ->setCompany($payload['company'] ?? null)
            ->setPhoneNumber($payload['phoneNumber'] ?? null);
    }
}
