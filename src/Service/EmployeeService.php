<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\EmployeeCommand;
use App\DTO\Employee\EmployeeDTO;
use App\Repository\CompanyRepository;
use App\Repository\EmployeeRepository;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EmployeeService
{
    private EmployeeRepository $employeeRepository;
    private CompanyRepository $companyRepository;
    private ValidatorInterface $validator;

    public function __construct(
        EmployeeRepository $employeeRepository,
        CompanyRepository  $companyRepository,
        ValidatorInterface $validator
    )
    {
        $this->employeeRepository = $employeeRepository;
        $this->companyRepository = $companyRepository;
        $this->validator = $validator;
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
        $this->validateEmployeeCommand($employeeCommand, EmployeeCommand::CREATE_GROUP);

        $companies = $this->getCompanies($employeeCommand->getCompany());

        return $this->employeeRepository->create($employeeCommand, $companies);
    }

    public function updateEmployee(int $id, EmployeeCommand $employeeCommand): void
    {
        $this->validateEmployeeCommand($employeeCommand, EmployeeCommand::UPDATE_GROUP);
        $companies = $employeeCommand->getCompany() ?
            $this->getCompanies($employeeCommand->getCompany())
            : [];

        $this->employeeRepository->update($id, $employeeCommand, $companies);
    }

    private function getCompanies(array $companiesId): array
    {
        $companies = $this->companyRepository->findBy([
            'id' => $companiesId
        ]);

        if (count($companies) !== count($companiesId)) {
            throw new BadRequestException('Not all companies found');
        }

        return $companies;
    }

    private function validateEmployeeCommand(EmployeeCommand $employeeCommand, string $group): void
    {
        $errors = $this->validator->validate($employeeCommand, null, $group);

        if ($errors->count() > 0) {
            throw new BadRequestException((string)$errors);
        }
    }

    public function deleteEmployeeById(int $id): void
    {
        $this->employeeRepository->deleteById($id);
    }
}
