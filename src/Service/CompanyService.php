<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\CompanyCommand;
use App\DTO\Company\CompanyDTO;
use App\DTO\Company\Factory\CompanyDTOFactory;
use App\Entity\Company;
use App\Repository\CompanyRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CompanyService
{
    public function __construct(
        private readonly CompanyRepository $companyRepository
    ) {
    }

    public function getAllCompanies(): array
    {
        return $this->companyRepository->getAll();
    }

    public function getCompanyById(int $id): CompanyDTO
    {
        return $this->companyRepository->getCompanyById($id);
    }

    public function getCompanyByNip(string $nip): ?CompanyDTO
    {
        /** @var Company $companyEntity */
        $companyEntity = $this->companyRepository->findBy([
            'nip' => $nip
        ]);

        return $companyEntity
            ? CompanyDTOFactory::createFromEntity($companyEntity)
            : null;
    }

    public function createCompany(CompanyCommand $companyCommand): int
    {
        return $this->companyRepository->create($companyCommand);
    }

    public function updateCompany(int $id, CompanyCommand $companyCommand): void
    {
        $this->companyRepository->update($id, $companyCommand);
    }

    public function deleteCompanyById(int $id): void
    {
        $this->companyRepository->deleteById($id);
    }

    /**
     * @return Company[]
     */
    public function getCompanies(array $companiesId): array
    {
        $companies = $this->companyRepository->findBy([
            'id' => $companiesId
        ]);

        if (count($companies) !== count($companiesId)) {
            throw new BadRequestHttpException('Not all companies were found!');
        }

        return $companies;
    }
}
