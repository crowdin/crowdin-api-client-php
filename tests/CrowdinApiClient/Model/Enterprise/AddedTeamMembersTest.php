<?php

namespace CrowdinApiClient\Tests\Model\Enterprise;

use CrowdinApiClient\Collection;
use CrowdinApiClient\Model\Enterprise\AddedTeamMembers;
use CrowdinApiClient\Model\Enterprise\TeamMember;
use PHPUnit\Framework\TestCase;

class AddedTeamMembersTest extends TestCase
{
    /**
     * @var AddedTeamMembers
     */
    public $addedTeamMembers;

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
        $this->addedTeamMembers = new AddedTeamMembers($this->data);
        $this->checkData();
    }

    public function testSetData(): void
    {
        $this->addedTeamMembers = new AddedTeamMembers();

        $collection = new Collection();
        $collection->add(new TeamMember($this->data['added'][0]['data']));
        $this->addedTeamMembers->setAdded($collection);

        $collection = new Collection();
        $collection->add(new TeamMember($this->data['skipped'][0]['data']));
        $this->addedTeamMembers->setSkipped($collection);

        $this->assertEquals(
            $this->addedTeamMembers->getSkipped()[0]->getUsername(),
            $this->data['skipped'][0]['data']['username']
        );
        $this->assertEquals(
            $this->addedTeamMembers->getSkipped()[0]->getFirstName(),
            $this->data['skipped'][0]['data']['firstName']
        );
        $this->assertEquals(
            $this->addedTeamMembers->getSkipped()[0]->getLastName(),
            $this->data['skipped'][0]['data']['lastName']
        );
        $this->assertEquals(
            $this->addedTeamMembers->getSkipped()[0]->getAvatarUrl(),
            $this->data['skipped'][0]['data']['avatarUrl']
        );
        $this->assertEquals(
            $this->addedTeamMembers->getSkipped()[0]->getAddedAt(),
            $this->data['skipped'][0]['data']['addedAt']
        );
    }

    public function checkData(): void
    {
        $this->assertEquals(
            $this->data['added'][0]['data']['username'],
            $this->addedTeamMembers->getAdded()[0]->getUsername()
        );
        $this->assertEquals(
            $this->data['added'][0]['data']['firstName'],
            $this->addedTeamMembers->getAdded()[0]->getFirstName()
        );
        $this->assertEquals(
            $this->data['added'][0]['data']['lastName'],
            $this->addedTeamMembers->getAdded()[0]->getLastName()
        );
        $this->assertEquals(
            $this->data['added'][0]['data']['avatarUrl'],
            $this->addedTeamMembers->getAdded()[0]->getAvatarUrl()
        );
        $this->assertEquals(
            $this->data['added'][0]['data']['addedAt'],
            $this->addedTeamMembers->getAdded()[0]->getAddedAt()
        );

        $this->assertEquals(
            $this->data['skipped'][0]['data']['username'],
            $this->addedTeamMembers->getSkipped()[0]->getUsername()
        );
        $this->assertEquals(
            $this->data['skipped'][0]['data']['firstName'],
            $this->addedTeamMembers->getSkipped()[0]->getFirstName()
        );
        $this->assertEquals(
            $this->data['skipped'][0]['data']['lastName'],
            $this->addedTeamMembers->getSkipped()[0]->getLastName()
        );
        $this->assertEquals(
            $this->data['skipped'][0]['data']['avatarUrl'],
            $this->addedTeamMembers->getSkipped()[0]->getAvatarUrl()
        );
        $this->assertEquals(
            $this->data['skipped'][0]['data']['addedAt'],
            $this->addedTeamMembers->getSkipped()[0]->getAddedAt()
        );
    }
}
