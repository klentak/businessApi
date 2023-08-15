<?php

declare(strict_types=1);

namespace App\Command\Factory;

use App\Command\UpdateEmployeeCommand;

class UpdateEmployeeCommandFactory
{
    public static function createFromPayload(array $payload): UpdateEmployeeCommand
    {
        return (new UpdateEmployeeCommand())
            ->setName($payload['name'] ?? null)
            ->setSurname($payload['surname'] ?? null)
            ->setEmail($payload['email'] ?? null)
            ->setCompanies($payload['company'] ?? null)
            ->setPhoneNumber($payload['phoneNumber'] ?? null);
    }
}
