<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\CompanyCommand;
use App\DTO\Company\CompanyDTO;
use App\Repository\CompanyRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CompanyService
{
    private CompanyRepository $companyRepository;
    private ValidatorInterface $validator;

    public function __construct(CompanyRepository $companyRepository, ValidatorInterface $validator)
    {
        $this->companyRepository = $companyRepository;
        $this->validator = $validator;
    }

    public function getAllCompanies(): array
    {
        return $this->companyRepository->getAll();
    }

    public function getCompanyById(int $id): CompanyDTO
    {
        return $this->companyRepository->getCompanyById($id);
    }

    public function createCompany(CompanyCommand $employeeCommand): int
    {
        return $this->companyRepository->create($employeeCommand);
    }

    public function updateCompany(int $id, CompanyCommand $employeeCommand): void
    {
        $this->companyRepository->update($id, $employeeCommand);
    }

    public function deleteCompanyById(int $id): void
    {
        $this->companyRepository->deleteById($id);
    }
}
