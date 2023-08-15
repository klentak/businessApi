<?php

declare(strict_types=1);

namespace App\Repository;

use App\Command\CreateCompanyCommand;
use App\Command\UpdateCompanyCommand;
use App\DTO\Company\Factory\CompanyDTOFactory;
use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function save(Company $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Company $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAll(): array
    {
        return CompanyDTOFactory::createCollectionFromArrayEntity(
            $this->findAll()
        );
    }

    public function deleteById(int $id): void
    {
        $this->remove(
            $this->getById($id, true),
            true
        );
    }

    public function create(CreateCompanyCommand $employeeCommand): int
    {
        $company = (new Company())
            ->setName($employeeCommand->getName())
            ->setNip($employeeCommand->getNip())
            ->setAddress($employeeCommand->getAddress())
            ->setCity($employeeCommand->getCity())
            ->setPostcode($employeeCommand->getPostCode());

        $this->save($company, true);

        return $company->getId()
            ?? throw new RuntimeException('Error occurred while inserting to database');
    }

    public function update(UpdateCompanyCommand $companyCommand)
    {
        $company = $this->getById($companyCommand->getId(), true);

        if ($name = $companyCommand->getName()) {
            $company->setName($name);
        }

        if ($nip = $companyCommand->getNip()) {
            $company->setNip($nip);
        }

        if ($address = $companyCommand->getAddress()) {
            $company->setAddress($address);
        }

        if ($city = $companyCommand->getCity()) {
            $company->setCity($city);
        }

        if ($postCode = $companyCommand->getPostCode()) {
            $company->setPostcode($postCode);
        }

        $this->getEntityManager()->flush();
    }

    public function getById(int $id, $withThrow = false): ?Company
    {
        /** @var Company $company */
        $company = $this->find($id);

        if (
            $withThrow
            && !$company instanceof Company
        ) {
            throw new NotFoundHttpException(
                sprintf('No Employee found for id: "%s"', $id)
            );
        }

        return $company;
    }

    public function checkIfCompanyWithGivenNipExistAndNotBelongsToCompany(int $id, string $nip): bool
    {
        return !!$this->createQueryBuilder('c')
            ->where('c.nip = :nip')
            ->andWhere('c.id != :id')
            ->setParameters([
                'id' => $id,
                'nip' => $nip,
            ])
            ->getQuery()
            ->getResult();
    }
}
