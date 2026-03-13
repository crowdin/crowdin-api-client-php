<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Model\Enterprise\AddedTeamMembers;
use PHPUnit\Framework\TestCase;

class AddedTeamMembersTest extends TestCase
{
    public $data = [
        'skipped' => [
            [
                'data' => [
                    'id' => 1,
                    'username' => 'john.doe',
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'avatarUrl' => '',
                    'addedAt' => '2019-09-23T09:04:29+00:00',
                ],
            ],
        ],
        'added' => [
            [
                'data' => [
                    'id' => 1,
                    'username' => 'john.doe',
                    'firstName' => 'John',
                    'lastName' => 'Doe',
                    'avatarUrl' => '',
                    'addedAt' => '2019-09-23T09:04:29+00:00',
                ],
            ],
        ],

    ];

    public function testLoadData(): void
    {
        $addedTeamMembers = new AddedTeamMembers($this->data);
        $this->assertEquals(
            $this->data['added'][0]['data']['username'],
            $addedTeamMembers->getAdded()[0]->getUsername()
        );
        $this->assertEquals(
            $this->data['added'][0]['data']['firstName'],
            $addedTeamMembers->getAdded()[0]->getFirstName()
        );
        $this->assertEquals(
            $this->data['added'][0]['data']['lastName'],
            $addedTeamMembers->getAdded()[0]->getLastName()
        );
        $this->assertEquals(
            $this->data['added'][0]['data']['avatarUrl'],
            $addedTeamMembers->getAdded()[0]->getAvatarUrl()
        );
        $this->assertEquals(
            $this->data['added'][0]['data']['addedAt'],
            $addedTeamMembers->getAdded()[0]->getAddedAt()
        );

        $this->assertEquals(
            $this->data['skipped'][0]['data']['username'],
            $addedTeamMembers->getSkipped()[0]->getUsername()
        );
        $this->assertEquals(
            $this->data['skipped'][0]['data']['firstName'],
            $addedTeamMembers->getSkipped()[0]->getFirstName()
        );
        $this->assertEquals(
            $this->data['skipped'][0]['data']['lastName'],
            $addedTeamMembers->getSkipped()[0]->getLastName()
        );
        $this->assertEquals(
            $this->data['skipped'][0]['data']['avatarUrl'],
            $addedTeamMembers->getSkipped()[0]->getAvatarUrl()
        );
        $this->assertEquals(
            $this->data['skipped'][0]['data']['addedAt'],
            $addedTeamMembers->getSkipped()[0]->getAddedAt()
        );
    }
}
