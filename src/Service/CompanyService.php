<?php

declare(strict_types=1);

namespace App\Service;

use App\Command\CreateCompanyCommand;
use App\Command\UpdateCompanyCommand;
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

    public function getCompanyById(int $id, $withThrow = false): ?CompanyDTO
    {
        $company = $this->companyRepository->getById($id, $withThrow);

        return $company ? CompanyDTOFactory::createFromEntity($company) : null;
    }

    public function getCompanyByNip(string $nip): ?CompanyDTO
    {
        /** @var Company $companyEntity */
        $companyEntity = $this->companyRepository->findOneBy([
            'nip' => $nip
        ]);

        return $companyEntity
            ? CompanyDTOFactory::createFromEntity($companyEntity)
            : null;
    }

    public function createCompany(CreateCompanyCommand $companyCommand): int
    {
        if ($this->getCompanyByNip($companyCommand->getNip()) instanceof CompanyDTO) {
            throw new BadRequestHttpException(
                sprintf(
                    'Company with nip: "%s" already exist!',
                    $companyCommand->getNip()
                )
            );
        }

        return $this->companyRepository->create($companyCommand);
    }

    public function updateCompany(UpdateCompanyCommand $companyCommand): void
    {
        if (
            $companyCommand->getNip()
            && $this->companyRepository->checkIfCompanyWithGivenNipExistAndNotBelongsToCompany(
                $companyCommand->getId(),
                $companyCommand->getNip(),
            )
        ) {
            throw new BadRequestHttpException(
                sprintf(
                    'Company with nip: "%s" already exist!',
                    $companyCommand->getNip()
                )
            );
        }

        $this->companyRepository->update($companyCommand);
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
