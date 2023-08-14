<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\EmployeeCommand;
use App\DTO\Employee\EmployeeDTO;
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

    public function getEmployeeById(int $id): EmployeeDTO
    {
        return $this->employeeRepository->getEmployeeById($id);
    }

    public function createEmployee(EmployeeCommand $employeeCommand): int
    {
        $companies = $employeeCommand->getCompanies()
            ? $this->companyService->getCompanies($employeeCommand->getCompanies())
            : [];

        return $this->employeeRepository->create($employeeCommand, $companies);
    }

    public function updateEmployee(int $id, EmployeeCommand $employeeCommand): void
    {
        $companies = $employeeCommand->getCompanies()
            ? $this->companyService->getCompanies($employeeCommand->getCompanies())
            : [];

        $this->employeeRepository->update($id, $employeeCommand, $companies);
    }

    public function deleteEmployeeById(int $id): void
    {
        $this->employeeRepository->deleteById($id);
    }
}
