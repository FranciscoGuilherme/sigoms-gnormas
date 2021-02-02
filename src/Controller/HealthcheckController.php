<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Helpers\MessagesHelper\UsersMessagesHelper as Helper;

/**
 * @package App\Controller
 */
final class HealthcheckController extends AbstractController
{
    /**
     * @var EntityManagerInterface $entityManagerInterface
     */
    private EntityManagerInterface $entityManagerInterface;

    /**
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * @Route("/healthcheck", methods={"GET"}, name="healthcheck")
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $this->entityManagerInterface->getConnection()->connect();

            return new JsonResponse(['message' => 'Normas em funcionamento'], Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return new JsonResponse([
                'message' => Helper::DB_CONECTION_ERROR_MESSAGE,
                'details' => $e->getMessage()
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
