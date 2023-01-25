<?php

namespace App\Repository;

use App\Command\EmployeeCommand;
use App\DTO\Employee\EmployeeDTO;
use App\DTO\Employee\Factory\EmployeeDTOFactory;
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

    public function getEmployeeById(int $id): EmployeeDTO
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

        $this->save($employee, true);

        return $employee->getId()
            ?? throw new RuntimeException('Error occurred while inserting to database');
    }

    public function update(int $id, EmployeeCommand $employeeCommand, array $companies): void
    {
        $employee = $this->getEntityById($id, true);

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

    public function deleteById(int $id): void
    {
        $this->remove(
            $this->getEntityById($id, true),
            true
        );
    }

    private function getEntityById(int $id, $withThrow = false): ?Employee
    {
        /** @var Employee $employee */
        $employee = $this->find($id);

        if (
            $withThrow
            && !$employee instanceof Employee
        ) {
            throw new NotFoundHttpException(
                sprintf('No Employee found for id: "%s"', $id)
            );
        }

        return $employee;
    }
}
