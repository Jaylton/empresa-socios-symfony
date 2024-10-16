<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Entity\Socio;
use App\Repository\SocioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/socio')]
final class SocioController extends AbstractController
{
    #[Route('/', name: 'api_socio_index', methods: ['GET'])]
    public function index(SocioRepository $socioRepository): JsonResponse
    {
        $socios = $socioRepository->findAll();
        $data = [];

        foreach ($socios as $socio) {
            $data[] = [
                'id' => $socio->getId(),
                'nome' => $socio->getNome(),
                'cpf' => $socio->getCpf(),
                'empresa' => $socio->getEmpresa() ? $socio->getEmpresa()->getAll() : null,
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/new', name: 'api_socio_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['nome'], $data['cpf'], $data['empresa'])) {
            return new JsonResponse(['error' => 'Dados inválidos'], Response::HTTP_BAD_REQUEST);
        }

        $socio = new Socio();
        $socio->setNome($data['nome']);
        $socio->setCpf($data['cpf']);
        $empresa = $entityManager->getRepository(Empresa::class)->find($data['empresa']);
        if ($empresa) {
            $socio->setEmpresa($empresa);
        }

        $entityManager->persist($socio);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Sócio criado com sucesso'], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'api_socio_show', methods: ['GET'])]
    public function show(Socio $socio): JsonResponse
    {
        $data = [
            'id' => $socio->getId(),
            'nome' => $socio->getNome(),
            'cpf' => $socio->getCpf(),
            'empresa' => $socio->getEmpresa() ? $socio->getEmpresa()->getAll() : null,
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    #[Route('/{id}/edit', name: 'api_socio_edit', methods: ['PUT'])]
    public function edit(Request $request, Socio $socio, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['nome'], $data['cpf'], $data['empresa'])) {
            return new JsonResponse(['error' => 'Dados inválidos'], Response::HTTP_BAD_REQUEST);
        }

        $socio->setNome($data['nome']);
        $socio->setCpf($data['cpf']);
        $empresa = $entityManager->getRepository(Empresa::class)->find($data['empresa']);
        if ($empresa) {
            $socio->setEmpresa($empresa);
        }

        $entityManager->flush();

        return new JsonResponse(['message' => 'Sócio atualizado com sucesso'], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'api_socio_delete', methods: ['DELETE'])]
    public function delete(Socio $socio, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($socio);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Sócio removido com sucesso'], Response::HTTP_NO_CONTENT);
    }
}