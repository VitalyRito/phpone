<?php

namespace App\Modules\HealthCheck\Message\QueryHandler;

use App\Modules\HealthCheck\Message\Query\GetHealthCheckQuery;
use App\Modules\HealthCheck\Message\Response\HealthCheckResponse;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetHealthCheckQueryHandler implements MessageHandlerInterface
{
    public function __invoke(GetHealthCheckQuery $query): HealthCheckResponse
    {
        return new HealthCheckResponse();
    }
}
