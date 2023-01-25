<?php

declare(strict_types=1);

namespace App\DTO\Company\Factory;

use App\DTO\Company\CompanyDTO;
use App\Entity\Company;

class CompanyDTOFactory
{
    public static function createCollectionFromArrayEntity(array $employees): array
    {
        $result = [];

        foreach ($employees as $employee) {
            $result[] = self::createFromEntity($employee);
        }

        return $result;
    }

    public static function createFromEntity(Company $employee): CompanyDTO
    {
        return new CompanyDTO(
            $employee->getId(),
            $employee->getName(),
            $employee->getNip(),
            $employee->getAddress(),
            $employee->getCity(),
            $employee->getPostcode()
        );
    }
}
