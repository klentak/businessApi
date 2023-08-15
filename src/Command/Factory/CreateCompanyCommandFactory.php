<?php

namespace App\Command\Factory;

use App\Command\CreateCompanyCommand;

class CreateCompanyCommandFactory
{
    public static function createFromPayload(array $payload): CreateCompanyCommand
    {
        return (new CreateCompanyCommand())
            ->setName($payload['name'])
            ->setNip($payload['nip'])
            ->setAddress($payload['address'])
            ->setCity($payload['city'])
            ->setPostCode($payload['postCode']);
    }
}
