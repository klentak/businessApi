<?php

namespace App\Repository;

use App\Command\EmployeeCommand;
use App\DTO\Employee\EmployeeDTOFactory;
use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmployeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    public function save(Employee $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Employee $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAll(): array
    {
        return EmployeeDTOFactory::createCollectionFromArrayEntity(
            $this->findAll()
        );
    }

    public function getEmployeeById(int $id)
    {
        return EmployeeDTOFactory::createFromEntity(
            $this->find($id)
                ?? throw new NotFoundHttpException(sprintf('No Employee found for id: "%s"', $id))
        );
    }

    public function create(EmployeeCommand $employeeCommand, array $companies): ?int
    {
        $employee = (new Employee())
            ->setName($employeeCommand->getName())
            ->setSurname($employeeCommand->getSurname())
            ->setEmail($employeeCommand->getEmail())
            ->setPhoneNumber($employeeCommand->getPhoneNumber());

        foreach ($companies as $company) {
            $employee->addCompany($company);
        }

        $this->getEntityManager()->persist($employee);
        $this->getEntityManager()->flush();

        return $employee->getId()
            ?? throw new RuntimeException('Error occurred while inserting to database');
    }

    public function update(int $id, EmployeeCommand $employeeCommand, array $companies): void
    {
        /** @var Employee $employee */
        $employee = $this->find($id) ?? throw new NotFoundHttpException(
            sprintf('No Employee found for id: "%s"', $id)
        );

        if ($name = $employeeCommand->getName()) {
            $employee->setName($name);
        }

        if ($surname = $employeeCommand->getSurname()) {
            $employee->setSurname($surname);
        }

        if ($email = $employeeCommand->getEmail()) {
            $employee->setEmail($email);
        }

        if ($phoneNumber = $employeeCommand->getPhoneNumber()) {
            $employee->setPhoneNumber($phoneNumber);
        }

        foreach ($companies as $company) {
            $employee->addCompany($company);
        }

        $this->getEntityManager()->flush();
    }
}
