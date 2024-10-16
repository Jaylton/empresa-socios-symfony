<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Repository\EmpresaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/empresa')]
final class EmpresaController extends AbstractController
{
    #[Route('/', name: 'api_empresa_index', methods: ['GET'])]
    public function index(EmpresaRepository $empresaRepository): JsonResponse
    {
        $empresas = $empresaRepository->findAll();
        $data = [];

        foreach ($empresas as $empresa) {
            $data[] = [
                'id' => $empresa->getId(),
                'nome' => $empresa->getNome(),
                'cnpj' => $empresa->getCnpj(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/new', name: 'api_empresa_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['nome'], $data['cnpj'])) {
            return new JsonResponse(['error' => 'Dados inválidos'], Response::HTTP_BAD_REQUEST);
        }

        $empresa = new Empresa();
        $empresa->setNome($data['nome']);
        $empresa->setCnpj($data['cnpj']);

        $entityManager->persist($empresa);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Empresa criada com sucesso'], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'api_empresa_show', methods: ['GET'])]
    public function show(Empresa $empresa): JsonResponse
    {
        $data = [
            'id' => $empresa->getId(),
            'nome' => $empresa->getNome(),
            'cnpj' => $empresa->getCnpj(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/{id}/edit', name: 'api_empresa_edit', methods: ['PUT'])]
    public function edit(Request $request, Empresa $empresa, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['nome'], $data['cnpj'])) {
            return new JsonResponse(['error' => 'Dados inválidos'], Response::HTTP_BAD_REQUEST);
        }

        $empresa->setNome($data['nome']);
        $empresa->setCnpj($data['cnpj']);

        $entityManager->flush();

        return new JsonResponse(['message' => 'Empresa atualizada com sucesso'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'api_empresa_delete', methods: ['DELETE'])]
    public function delete(Empresa $empresa, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($empresa);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Empresa removida com sucesso'], Response::HTTP_NO_CONTENT);
    }
}