<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\Factory\EmployeeCommandFactory;
use App\Service\EmployeeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EmployeeController extends AbstractController
{
    private EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    #[Route('/employee', name: 'get-all-employee', methods: ['GET'])]
    public function getAllEmployees(): Response
    {
        return $this->json(
            $this->employeeService->getAllEmployees()
        );
    }

    #[Route('/employee', name: 'create-employee', methods: ['POST'])]
    public function createEmployee(Request $request, ValidatorInterface $validator): Response
    {
        return $this->json(
            $this->employeeService->createEmployee(
                EmployeeCommandFactory::createFromPayload(
                    $request->toArray()
                )
            )
        );
    }

    #[Route('/employee/{id}', name: 'get-employee', methods: ['GET'])]
    public function getEmployee(int $id): Response
    {
        return $this->json(
            $this->employeeService->getEmployeeById($id)
        );
    }

    #[Route('/employee/{id}', name: 'update-employee', methods: ['PUT'])]
    public function updateEmployee(int $id, Request $request): Response
    {
        $this->employeeService->updateEmployeeBy(
            $id,
            EmployeeCommandFactory::createFromPayload(
                $request->toArray()
            )
        );

        return new Response(null, 204);
    }
}
