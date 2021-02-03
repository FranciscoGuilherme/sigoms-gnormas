<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @package App\Controller
 */
final class CreateCompliancesController extends AbstractController
{
    /**
     * @var HttpClientInterface $httpClientInterface
     */
    private HttpClientInterface $httpClientInterface;

    /**
     * @param HttpClientInterface $httpClientInterface
     */
    public function __construct(HttpClientInterface $httpClientInterface)
    {
        $this->httpClientInterface = $httpClientInterface;
    }

    /**
     * @Route("/compliances", methods={"POST"}, name="compliances-create")
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $response = $this->httpClientInterface->request('POST', $_ENV['FAAS_NORMAS'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'json' => $request->toArray()
        ]);

        return new JsonResponse($response->toArray(), Response::HTTP_CREATED);
    }
}