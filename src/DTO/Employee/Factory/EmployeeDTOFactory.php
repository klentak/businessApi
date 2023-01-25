<?php

declare(strict_types=1);

namespace App\DTO\Employee\Factory;

use App\DTO\Employee\EmployeeDTO;
use App\Entity\Employee;

class EmployeeDTOFactory
{
    public static function createCollectionFromArrayEntity(array $employees): array
    {
        $result = [];

        foreach ($employees as $employee) {
            $result[] = self::createFromEntity($employee);
        }

        return $result;
    }

    public static function createFromEntity(Employee $employee): EmployeeDTO
    {
        return new EmployeeDTO(
            $employee->getId(),
            $employee->getName(),
            $employee->getSurname(),
            $employee->getEmail(),
            $employee->getPhoneNumber(),
            $employee->getCompany()->map(
                function($obj){return $obj->getId();}
            )->getValues()
        );
    }
}
