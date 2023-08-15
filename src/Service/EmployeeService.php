<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\CreateEmployeeCommand;
use App\Command\UpdateEmployeeCommand;
use App\DTO\Employee\EmployeeDTO;
use App\DTO\Employee\Factory\EmployeeDTOFactory;
use App\Repository\EmployeeRepository;

class EmployeeService
{
    public function __construct(
        private readonly EmployeeRepository $employeeRepository,
        private readonly CompanyService $companyService,
    ) {
    }

    public function getAllEmployees(): array
    {
        return $this->employeeRepository->getAll();
    }

    public function getEmployeeById(int $id, bool $withThrow = false): ?EmployeeDTO
    {
        $result = $this->employeeRepository->getEmployeeById($id, $withThrow);

        return $result
            ? EmployeeDTOFactory::createFromEntity($result)
            : null;
    }

    public function createEmployee(CreateEmployeeCommand $employeeCommand): int
    {
        $companiesEntities = $employeeCommand->getCompanies()
            ? $this->companyService->getCompanies($employeeCommand->getCompanies())
            : [];

        return $this->employeeRepository->create($employeeCommand, $companiesEntities);
    }

    public function updateEmployee(UpdateEmployeeCommand $employeeCommand): void
    {
        $companies = $employeeCommand->getCompanies()
            ? $this->companyService->getCompanies($employeeCommand->getCompanies())
            : [];

        $this->employeeRepository->update($employeeCommand, $companies);
    }

    public function deleteEmployeeById(int $id): void
    {
        $this->employeeRepository->deleteById($id);
    }
}
