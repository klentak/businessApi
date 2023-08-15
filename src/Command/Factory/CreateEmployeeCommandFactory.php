<?php

declare(strict_types=1);

namespace App\Command\Factory;

use App\Command\CreateEmployeeCommand;

class CreateEmployeeCommandFactory
{
    public static function createFromPayload(array $payload): CreateEmployeeCommand
    {
        return (new CreateEmployeeCommand())
            ->setName($payload['name'])
            ->setSurname($payload['surname'])
            ->setEmail($payload['email'])
            ->setCompanies($payload['company'])
            ->setPhoneNumber($payload['phoneNumber']);
    }
}
