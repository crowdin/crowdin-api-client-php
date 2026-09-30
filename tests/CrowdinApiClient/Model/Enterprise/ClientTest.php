<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testLoadData(): void
    {
        $client = new Client([
            'id' => 1,
            'name' => 'Umbrella',
            'description' => 'Client organization',
            'status' => 'pending',
            'webUrl' => 'https://umbrella.crowdin.com',
        ]);

        $this->assertSame(1, $client->getId());
        $this->assertSame('Umbrella', $client->getName());
        $this->assertSame('Client organization', $client->getDescription());
        $this->assertSame('pending', $client->getStatus());
        $this->assertSame('https://umbrella.crowdin.com', $client->getWebUrl());
    }
}
