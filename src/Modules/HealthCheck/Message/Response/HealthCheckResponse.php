<?php

namespace App\Modules\HealthCheck\Message\Response;

final class HealthCheckResponse
{
    private bool $online = true;

    public function isOnline(): bool
    {
        return $this->online;
    }
}
