<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\AdvisorCheck;
use CrowdinApiClient\Model\AdvisorInsight;
use CrowdinApiClient\ModelCollection;

/**
 * Advisors inspect project content and report insights with metrics and recommendations.
 *
 * @package Crowdin\Api
 */
class AdvisorApi extends AbstractApi
{
    /**
     * Create Advisor Check
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.advisors.checks.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.advisors.checks.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data Omit both keys to re-check every inspector<br>
     * string $data[category] Can't be used with inspectors<br>
     * array $data[inspectors] Can't be used with category. List of key and options (mode: auto or all, promptId)
     * @return AdvisorCheck|null
     */
    public function createCheck(int $projectId, array $data = []): ?AdvisorCheck
    {
        return $this->_post(sprintf('projects/%d/advisors/checks', $projectId), AdvisorCheck::class, $data);
    }

    /**
     * Get Advisor Check Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.advisors.checks.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.advisors.checks.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $checkId
     * @return AdvisorCheck|null
     */
    public function getCheck(int $projectId, string $checkId): ?AdvisorCheck
    {
        return $this->_get(sprintf('projects/%d/advisors/checks/%s', $projectId, $checkId), AdvisorCheck::class);
    }

    /**
     * List Advisor Insights
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.advisors.insights.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.advisors.insights.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * boolean $params[isDismissed]<br>
     * string $params[status]<br>
     * string $params[outcome]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listInsights(int $projectId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('projects/%d/advisors/insights', $projectId), AdvisorInsight::class, $params);
    }

    /**
     * Edit Advisor Insight
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.advisors.insights.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.advisors.insights.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param AdvisorInsight $insight Only isDismissed can be changed
     * @return AdvisorInsight|null
     */
    public function updateInsight(int $projectId, AdvisorInsight $insight): ?AdvisorInsight
    {
        return $this->_update(sprintf('projects/%d/advisors/insights/%d', $projectId, $insight->getId()), $insight);
    }

    /**
     * Create or Update Application Advisor Insight
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.applications.modules.advisors.insights.put API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.applications.modules.advisors.insights.put API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $applicationIdentifier
     * @param string $moduleKey Key of the application's advisor-inspector module
     * @param array $data
     * string $data[outcome] required. Enum: "flagged" "clear" "not_applicable"<br>
     * string $data[checkedAt]<br>
     * array $data[metrics]<br>
     * array $data[recommendations]<br>
     * array $data[payload]
     * @return mixed
     */
    public function putApplicationInsight(
        int $projectId,
        string $applicationIdentifier,
        string $moduleKey,
        array $data
    ) {
        return $this->client->apiRequest(
            'put',
            sprintf(
                'projects/%d/applications/%s/modules/%s/advisors/insights',
                $projectId,
                $applicationIdentifier,
                $moduleKey
            ),
            null,
            [
                'body' => json_encode($data),
                'headers' => $this->getHeaders(),
            ]
        );
    }
}
