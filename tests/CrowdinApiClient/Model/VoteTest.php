<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Vote;
use PHPUnit\Framework\TestCase;

/**
 * Class VoteTest
 * @package Crowdin\Tests\Model
 */
class VoteTest extends TestCase
{
    public $vote;

    public $data = [
        'id' => 6643,
        'user' =>
            [
                'id' => 19,
                'login' => 'john_doe',
            ],
        'translationId' => 19069345,
        'votedAt' => '2019-09-19T12:42:12+00:00',
        'mark' => 'up',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->vote = new Vote($this->data);
    }

    public function testLoadData()
    {
        $this->assertEquals($this->data['id'], $this->vote->getId());
        $this->assertEquals($this->data['user'], $this->vote->getUser());
        $this->assertEquals($this->data['translationId'], $this->vote->getTranslationId());
        $this->assertEquals($this->data['votedAt'], $this->vote->getVotedAt());
        $this->assertEquals($this->data['mark'], $this->vote->getMark());
    }
}
