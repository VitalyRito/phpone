<?php

declare(strict_types=1);

namespace App\Tests\functional\Modules\HealthCheck;

use FunctionalTester;

final class GetHealthCheckQueryCest
{
    public function seePageIsAvailable(FunctionalTester $I)
    {
        $I->sendGet('/api/v1/health/status');

        $I->seeResponseCodeIs(200);
        $I->canSeeResponseIsJson();
        $I->canSeeResponseContainsJson(['online' => true]);
    }
}