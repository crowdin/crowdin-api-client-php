<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\AiFineTuningEvent;
use PHPUnit\Framework\TestCase;

class AiFineTuningEventTest extends TestCase
{
    public function testLoadData(): void
    {
        $data = [
            'id' => 'ftevent-1',
            'type' => 'metrics',
            'message' => 'Step 1/10',
            'data' => ['step' => 1, 'totalSteps' => 10, 'trainingLoss' => 0.5],
            'createdAt' => '2025-09-23T11:26:54+00:00',
        ];
        $event = new AiFineTuningEvent($data);

        $this->assertSame('ftevent-1', $event->getId());
        $this->assertSame('metrics', $event->getType());
        $this->assertSame('Step 1/10', $event->getMessage());
        $this->assertSame($data['data'], $event->getEventData());
        $this->assertSame('2025-09-23T11:26:54+00:00', $event->getCreatedAt());
        $this->assertSame($data, $event->getData(), 'BaseModel raw payload must stay intact');
    }

    public function testLoadDataWithoutEventData(): void
    {
        $event = new AiFineTuningEvent(['id' => 'ftevent-2', 'type' => 'message', 'message' => 'Started']);

        $this->assertSame([], $event->getEventData());
    }
}
