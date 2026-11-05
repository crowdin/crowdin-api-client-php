<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\Manager;
use CrowdinApiClient\ModelCollection;

/**
 * Managers are users you let manage your projects, TMs, glossaries, and style guides. Crowdin only.
 *
 * @package Crowdin\Api
 */
class ManagerApi extends AbstractApi
{
    /**
     * List Managers
     * @link https://developer.crowdin.com/api/v2/#operation/api.managers.getMany API Documentation
     *
     * @param array $params
     * string $params[status] active, pending or comma-separated list. Default is both<br>
     * string $params[email] Pending managers only<br>
     * string $params[search] Username or full name<br>
     * string $params[projectIds] One ID or comma-separated list<br>
     * string $params[orderBy]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('managers', Manager::class, $params);
    }

    /**
     * Get Manager
     * @link https://developer.crowdin.com/api/v2/#operation/api.managers.get API Documentation
     *
     * @param int $managerId The same as the manager's user ID
     * @return Manager|null
     */
    public function get(int $managerId): ?Manager
    {
        return $this->_get(sprintf('managers/%d', $managerId), Manager::class);
    }

    /**
     * Add Manager
     * @link https://developer.crowdin.com/api/v2/#operation/api.managers.post API Documentation
     *
     * @param array $data
     * string $data[username] Either username or email is required<br>
     * string $data[email] Either username or email is required. Unknown emails get an invitation<br>
     * integer[] $data[projectIds]<br>
     * integer[] $data[tmIds]<br>
     * integer[] $data[glossaryIds]<br>
     * integer[] $data[styleGuideIds] At least one of projectIds, tmIds, glossaryIds, styleGuideIds is required<br>
     * string $data[message] Personal message added to the notification email
     * @return Manager|null
     */
    public function create(array $data): ?Manager
    {
        return $this->_create('managers', Manager::class, $data);
    }

    /**
     * Edit Manager
     * @link https://developer.crowdin.com/api/v2/#operation/api.managers.patch API Documentation
     *
     * @param Manager $manager Only projectIds, tmIds, glossaryIds and styleGuideIds can be changed
     * @return Manager|null
     */
    public function update(Manager $manager): ?Manager
    {
        return $this->_update(sprintf('managers/%d', $manager->getId()), $manager);
    }

    /**
     * Delete Manager
     *
     * Removes a manager or cancels a pending invitation.
     * @link https://developer.crowdin.com/api/v2/#operation/api.managers.delete API Documentation
     *
     * @param int $managerId
     * @return mixed
     */
    public function delete(int $managerId)
    {
        return $this->_delete(sprintf('managers/%d', $managerId));
    }
}
