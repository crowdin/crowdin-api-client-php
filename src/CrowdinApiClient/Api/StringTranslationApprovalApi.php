<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\StringTranslationApproval;

/**
 * Class StringTranslationApprovalApi
 * @package Crowdin\Api
 */
class StringTranslationApprovalApi extends AbstractApi
{
    /**
     * @param int $projectId
     * @param array $params
     * @return mixed
     */
    public function list(int $projectId, array $params = [])
    {
        $path = sprintf('projects/%s/approvals', $projectId);
        return $this->_list($path, StringTranslationApproval::class, $params);
    }

    /**
     * @param int $projectId
     * @param int $approvalId
     * @return StringTranslationApproval|null
     */
    public function get(int $projectId, int $approvalId): ?StringTranslationApproval
    {
        $path = sprintf('projects/%d/approvals/%d', $projectId, $approvalId);

        return $this->_get($path, StringTranslationApproval::class);
    }

    /**
     * @param int $projectId
     * @param array $data
     * @return StringTranslationApproval|null
     */
    public function create(int $projectId, array $data): ?StringTranslationApproval
    {
        $path = sprintf('projects/%d/approvals', $projectId);

        return $this->_create($path, StringTranslationApproval::class, $data);
    }

    public function update(int $projectId, StringTranslationApproval $stringTranslationApproval)
    {
        $path = sprintf('projects/%d/approvals', $projectId);

        return $this->_update($path, $stringTranslationApproval);
    }

    /**
     * @param int $projectId
     * @param int $approvalId
     * @return mixed
     */
    public function delete(int $projectId, int $approvalId)
    {
        $path = sprintf('projects/%d/approvals/%d', $projectId, $approvalId);
        return $this->_delete($path);
    }
}
