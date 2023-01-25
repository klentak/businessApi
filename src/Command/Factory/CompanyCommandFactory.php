<?php

namespace App\Command\Factory;

use App\Command\CompanyCommand;

class CompanyCommandFactory
{
    public static function createFromPayload(array $payload): CompanyCommand
    {
        return (new CompanyCommand())
            ->setName($payload['name'] ?? null)
            ->setNip($payload['nip'] ?? null)
            ->setAddress($payload['address'] ?? null)
            ->setCity($payload['city'] ?? null)
            ->setPostCode($payload['postCode'] ?? null);
    }
}
