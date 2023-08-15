<?php

namespace App\Command\Factory;

use App\Command\UpdateCompanyCommand;

class UpdateCompanyCommandFactory
{
    public static function createFromPayload(array $payload): UpdateCompanyCommand
    {
        return (new UpdateCompanyCommand())
            ->setName($payload['name'] ?? null)
            ->setNip($payload['nip'] ?? null)
            ->setAddress($payload['address'] ?? null)
            ->setCity($payload['city'] ?? null)
            ->setPostCode($payload['postCode'] ?? null);
    }
}
