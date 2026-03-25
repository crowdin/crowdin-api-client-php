<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\HourlyUserReportSettingsTemplate;
use CrowdinApiClient\Model\ProjectMember;
use CrowdinApiClient\Model\ProjectMemberAddedStatistics;
use CrowdinApiClient\Model\Report;
use CrowdinApiClient\Model\User;
use CrowdinApiClient\Model\UserReportSettingsTemplate;
use CrowdinApiClient\ModelCollection;

/**
 * Users API gives you the possibility to get profile information about the currently authenticated user.
 *
 * @package Crowdin\Api
 */
class UserApi extends AbstractApi
{
    /**
     * Get Authenticated User
     * @link https://developer.crowdin.com/api/v2/#operation/api.user.get API Documentation
     *
     * @return User|null
     */
    public function getAuthenticatedUser(): ?User
    {
        return $this->_get('user', User::class);
    }

    /**
     * Update Authenticated User
     * @link https://developer.crowdin.com/api/v2/#operation/api.user.patch API Documentation
     *
     * @param User $user
     * @return User|null
     */
    public function updateAuthenticatedUser(User $user): ?User
    {
        return $this->_update('user', $user);
    }

    /**
     * @deprecated This method returns wrong model. Use listProjectMembers method instead.
     *
     * List Project Members
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.getMany API Documentation
     *
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('projects/%d/members', $projectId), User::class, $params);
    }

    /**
     * @deprecated This method returns wrong model. Use getProjectMemberInfo method instead.
     *
     * Get Member Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.get API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     * @return User
     */
    public function get(int $projectId, int $memberId): User
    {
        return $this->_get(sprintf('projects/%d/members/%d', $projectId, $memberId), User::class);
    }

    /**
     * List Project Members
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.getMany API Documentation
     *
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function listProjectMembers(int $projectId, array $params = []): ModelCollection
    {
        return $this->_list(sprintf('projects/%d/members', $projectId), ProjectMember::class, $params);
    }

    /**
     * Add Project Member
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.post API Documentation
     *
     * @param int $projectId
     * @param array $data
     * @return ProjectMemberAddedStatistics
     */
    public function addProjectMember(int $projectId, array $data): ProjectMemberAddedStatistics
    {
        return $this->_post(sprintf('projects/%d/members', $projectId), ProjectMemberAddedStatistics::class, $data);
    }

    /**
     * Get Member Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.get API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     * @return ProjectMember|null
     */
    public function getProjectMemberInfo(int $projectId, int $memberId): ?ProjectMember
    {
        return $this->_get(sprintf('projects/%d/members/%d', $projectId, $memberId), ProjectMember::class);
    }

    /**
     * Replace Project Member Permissions
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.put API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     * @param array $data
     * @return ProjectMember|null
     */
    public function replaceProjectMemberPermissions(
        int $projectId,
        int $memberId,
        array $data
    ): ?ProjectMember {
        return $this->_put(
            sprintf('projects/%d/members/%d', $projectId, $memberId),
            ProjectMember::class,
            $data
        );
    }

    /**
     * Delete Member From Project
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.members.delete API Documentation
     *
     * @param int $projectId
     * @param int $memberId
     */
    public function deleteMemberFromProject(int $projectId, int $memberId): void
    {
        $this->_delete(sprintf('projects/%d/members/%s', $projectId, $memberId));
    }

    /**
     * List User Report Settings Templates
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.reports.settings-templates.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.reports.settings-templates.getMany API Documentation Enterprise
     *
     * @param int $userId
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listReportSettingsTemplates(int $userId, array $params = []): ModelCollection
    {
        $options = [];
        if ($params !== []) {
            $options['params'] = $params;
        }

        $path = sprintf('users/%d/reports/settings-templates', $userId);
        $response = $this->client->apiRequest('get', $path, null, $options);

        $modelCollection = new ModelCollection();
        $modelCollection->setPagination($response['pagination']);

        foreach ($response['data'] as $item) {
            $modelCollection->add($this->makeUserReportSettingsTemplate($item['data']));
        }

        return $modelCollection;
    }

    /**
     * Create User Report Settings Template
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.reports.settings-templates.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.reports.settings-templates.post API Documentation Enterprise
     *
     * @param int $userId
     * @param array $data
     * string $data[name] required<br>
     * string $data[currency] required<br>
     * string $data[unit] required<br>
     * array $data[config] required
     * @return UserReportSettingsTemplate|HourlyUserReportSettingsTemplate|null
     */
    public function createReportSettingsTemplate(int $userId, array $data)
    {
        $path = sprintf('users/%d/reports/settings-templates', $userId);
        $options = ['body' => json_encode($data), 'headers' => $this->getHeaders()];
        $response = $this->client->apiRequest('post', $path, null, $options);

        return $this->makeUserReportSettingsTemplate($response['data']);
    }

    /**
     * Get User Report Settings Template
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.reports.settings-templates.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.reports.settings-templates.get API Documentation Enterprise
     *
     * @param int $userId
     * @param int $reportSettingsTemplateId
     * @return UserReportSettingsTemplate|HourlyUserReportSettingsTemplate|null
     */
    public function getReportSettingsTemplate(int $userId, int $reportSettingsTemplateId)
    {
        $path = sprintf('users/%d/reports/settings-templates/%d', $userId, $reportSettingsTemplateId);
        $response = $this->client->apiRequest('get', $path);

        return $this->makeUserReportSettingsTemplate($response['data']);
    }

    /**
     * Delete User Report Settings Template
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.reports.settings-templates.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.reports.settings-templates.delete API Documentation Enterprise
     *
     * @param int $userId
     * @param int $reportSettingsTemplateId
     */
    public function deleteReportSettingsTemplate(int $userId, int $reportSettingsTemplateId): void
    {
        $this->_delete(sprintf('users/%d/reports/settings-templates/%d', $userId, $reportSettingsTemplateId));
    }

    /**
     * Update User Report Settings Template
     * @link https://developer.crowdin.com/api/v2/#operation/api.users.reports.settings-templates.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.users.reports.settings-templates.patch API Documentation Enterprise
     *
     * @param int $userId
     * @param UserReportSettingsTemplate|HourlyUserReportSettingsTemplate $reportSettingsTemplate
     * @return UserReportSettingsTemplate|HourlyUserReportSettingsTemplate|null
     */
    public function updateReportSettingsTemplate(int $userId, $reportSettingsTemplate)
    {
        return $this->_update(
            sprintf('users/%d/reports/settings-templates/%d', $userId, $reportSettingsTemplate->getId()),
            $reportSettingsTemplate
        );
    }

    /**
     * @return HourlyUserReportSettingsTemplate|UserReportSettingsTemplate
     */
    private function makeUserReportSettingsTemplate(array $data)
    {
        if (($data['unit'] ?? '') === Report::UNIT_HOURS) {
            return new HourlyUserReportSettingsTemplate($data);
        }

        return new UserReportSettingsTemplate($data);
    }
}
