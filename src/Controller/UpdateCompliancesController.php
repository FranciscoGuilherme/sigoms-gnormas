<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\MessageBus\Message\StandardMessage;

/**
 * @package App\Controller
 */
final class UpdateCompliancesController extends AbstractController
{
    /**
     * @var HttpClientInterface $httpClientInterface
     */
    private HttpClientInterface $httpClientInterface;

    /**
     * @var MessageBusInterface $messageBusInterface
     */
    private MessageBusInterface $messageBusInterface;

    /**
     * @param HttpClientInterface $httpClientInterface
     * @param MessageBusInterface $messageBusInterface
     */
    public function __construct(
        HttpClientInterface $httpClientInterface,
        MessageBusInterface $messageBusInterface
    ) {
        $this->httpClientInterface = $httpClientInterface;
        $this->messageBusInterface = $messageBusInterface;
    }

    /**
     * @Route("/gnormas/compliances", methods={"PUT"}, name="compliances-update")
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $response = $this->httpClientInterface->request('PUT', $_ENV['FAAS_NORMAS'], [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'json' => $request->toArray()
            ]);

            $this->messageBusInterface->dispatch(new StandardMessage("Base de normas atualizada"));

            return new JsonResponse($response->toArray(), Response::HTTP_PARTIAL_CONTENT);
        } catch  (\Throwable $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}