<?php

namespace App\Modules\HealthCheck\Controller;

use App\Core\Controller\ControllerResponseTrait;
use App\Modules\HealthCheck\Message\Query\GetHealthCheckQuery;
use App\Modules\HealthCheck\Message\Response\HealthCheckResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/v1/health")
 */
final class HealthCheckController extends AbstractController
{
    use ControllerResponseTrait;

    private MessageBusInterface $queryBus;

    public function __construct(
        MessageBusInterface $queryBus,
        SerializerInterface $serializer
    ) {
        $this->queryBus = $queryBus;
        $this->serializer = $serializer;
    }

    /**
     * @OA\Tag(name="Health")
     * @OA\Response(
     *     @Model(type=HealthCheckResponse::class),
     *     response=Response::HTTP_OK,
     *     description="Successful fetch health status."
     * )
     * @Route("/status", methods={"GET"})
     * @param GetHealthCheckQuery $query
     * @return Response
     */
    public function getHealthCheck(GetHealthCheckQuery $query): Response
    {
        $envelope = $this->queryBus->dispatch($query);

        return $this->createJsonResponseFromEnvelope($envelope);
    }
}
