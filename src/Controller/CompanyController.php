<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\Factory\CompanyCommandFactory;
use App\Request\CreateCompanyRequest;
use App\Service\CompanyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends AbstractController
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    #[Route('/company', name: 'get-all-companies', methods: ['GET'])]
    public function getAllEmployees(): Response
    {
        return $this->json(
            $this->companyService->getAllCompanies()
        );
    }

    #[Route('/company', name: 'create-company', methods: ['POST'])]
    public function createCompany(CreateCompanyRequest $request): Response
    {
        return $this->json(
            $this->companyService->createCompany(
                CompanyCommandFactory::createFromPayload(
                    $request->toArray()
                )
            )
        );
    }

    #[Route('/company/{id}', name: 'get-company', methods: ['GET'])]
    public function getEmployee(int $id): Response
    {
        return $this->json(
            $this->companyService->getCompanyById($id)
        );
    }

    #[Route('/company/{id}', name: 'update-company', methods: ['PUT'])]
    public function updateCompany(int $id, CreateCompanyRequest $request): Response
    {
        $this->companyService->updateCompany(
            $id,
            CompanyCommandFactory::createFromPayload(
                $request->toArray()
            )
        );

        return new Response(null, 204);
    }

    #[Route('/company/{id}', name: 'delete-company', methods: ['DELETE'])]
    public function deleteEmployee(int $id): Response
    {
        $this->companyService->deleteCompanyById($id);

        return new Response(null, 204);
    }
}
