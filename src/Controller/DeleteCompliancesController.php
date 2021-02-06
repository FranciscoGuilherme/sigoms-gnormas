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
final class DeleteCompliancesController extends AbstractController
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
     * @Route("/gnormas/compliances", methods={"DELETE"}, name="compliances-delete")
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $response = $this->httpClientInterface->request('DELETE', $_ENV['FAAS_NORMAS'], [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'json' => $request->toArray()
            ]);

            return new JsonResponse($response->toArray(), Response::HTTP_NO_CONTENT);
        } catch  (\Throwable $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}