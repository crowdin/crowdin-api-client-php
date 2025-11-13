<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\LanguageTranslation;
use CrowdinApiClient\Model\StringTranslation;
use CrowdinApiClient\Model\StringTranslationApproval;
use CrowdinApiClient\Model\Vote;
use CrowdinApiClient\ModelCollection;

/**
 * Use API to add or remove strings translations, approvals, and votes.
 *
 * @package Crowdin\Api
 */
class StringTranslationApi extends AbstractApi
{
    /**
     * List Translation Approvals
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.approvals.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.approvals.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[fileId]  Must be used together with languageId<br>
     * string $params[labelIds]<br>
     * string $params[excludeLabelIds]<br>
     * integer $params[stringId] Must be used together with languageId<br>
     * string $params[languageId] Must be used together with stringId or fileId<br>
     * integer $params[translationId] If specified, fileId, stringId and languageId are ignored<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listApprovals(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%s/approvals', $projectId);
        return $this->_list($path, StringTranslationApproval::class, $params);
    }

    /**
     * Add Approval
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.approvals.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.approvals.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * integer $data[translationId] required
     * @return StringTranslationApproval|null
     */
    public function createApproval(int $projectId, array $data): ?StringTranslationApproval
    {
        $path = sprintf('projects/%d/approvals', $projectId);

        return $this->_create($path, StringTranslationApproval::class, $data);
    }

    /**
     * Approval Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.approvals.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.approvals.get API Documentation Enterprise
     */
    public function getApproval(int $projectId, int $approvalId): ?StringTranslationApproval
    {
        $path = sprintf('projects/%d/approvals/%d', $projectId, $approvalId);
        return $this->_get($path, StringTranslationApproval::class);
    }

    /**
     * Remove Approval
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.approvals.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.approvals.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $approvalId
     * @return mixed
     */
    public function deleteApproval(int $projectId, int $approvalId)
    {
        $path = sprintf('projects/%d/approvals/%d', $projectId, $approvalId);
        return $this->_delete($path);
    }

    /**
     * Remove String Approvals
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.approvals.deleteMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.approvals.deleteMany API Documentation Enterprise
     */
    public function deleteStringApprovals(int $projectId, int $stringId): void
    {
        $this->_delete(sprintf('projects/%d/approvals', $projectId), ['stringId' => $stringId]);
    }

    /**
     * List Language Translations
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.languages.translations.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.languages.translations.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param string $languageId
     * @param array $params
     * string $params[orderBy]<br>
     * string $params[stringIds]<br>
     * string $params[labelIds]<br>
     * int $params[fileId]<br>
     * int $params[branchId]<br>
     * int $params[directoryId]<br>
     * int $params[approvedOnly]<br>
     * string $params[croql]<br>
     * int $params[denormalizePlaceholders]<br>
     * int $params[limit]<br>
     * int $params[offset]
     * @return ModelCollection
     */
    public function listLanguageTranslations(int $projectId, string $languageId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/languages/%s/translations', $projectId, $languageId);
        return $this->_list(
            $path,
            LanguageTranslation::class,
            $params
        );
    }

    /**
     * List String Translations
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.getMany  API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.getMany  API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[stringId] required<br>
     * integer $params[languageId] required<br>
     * integer $params[denormalizePlaceholders]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/translations', $projectId);
        return $this->_list($path, StringTranslation::class, $params);
    }

    /**
     * Add Translation
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.add API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.add API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * integer $data[stringId] required<br>
     * integer $data[languageId] required<br>
     * string $data[text] required<br>
     * string $data[pluralCategoryName]
     * @return StringTranslation|null
     */
    public function create(int $projectId, array $data): ?StringTranslation
    {
        $path = sprintf('projects/%d/translations', $projectId);
        return $this->_create($path, StringTranslation::class, $data);
    }

    /**
     * Delete String Translations
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.deleteMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.deleteMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $stringId
     * @param null|string $languageId
     * @return mixed
     */
    public function deleteStringTranslations(int $projectId, int $stringId, ?string $languageId = null)
    {
        $params = [
            'stringId' => $stringId,
        ];

        if ($languageId !== null) {
            $params['languageId'] = $languageId;
        }

        return $this->_delete(sprintf('projects/%d/translations', $projectId), $params);
    }

    /**
     * Get Translation
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.get API Documentation Enterprise
     */
    public function get(int $projectId, int $translationId): ?StringTranslation
    {
        $path = sprintf('projects/%d/translations/%d', $projectId, $translationId);
        return $this->_get($path, StringTranslation::class);
    }

    /**
     * Restore Translation
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.put  API Documentation Enterprise
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.put  API Documentation Enterprise
     */
    public function restore(int $projectId, int $translationId): ?StringTranslation
    {
        $path = sprintf('projects/%d/translations/%d', $projectId, $translationId);
        return $this->_put($path, StringTranslation::class, []);
    }

    /**
     * Delete Translation
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.delete API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $translationId
     * @return mixed
     */
    public function delete(int $projectId, int $translationId)
    {
        $path = sprintf('projects/%d/translations/%d', $projectId, $translationId);
        return $this->_delete($path);
    }

    /**
     * List Translation Votes
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.votes.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.votes.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * integer $params[stringId] Must be used together with languageId<br>
     * string $params[languageId] Must be used together with stringId<br>
     * integer $params[translationId] If specified, stringId and languageId are ignored<br>
     * string $params[labelIds]<br>
     * string $params[excludeLabelIds]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function listVotes(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/votes', $projectId);
        return $this->_list($path, Vote::class, $params);
    }

    /**
     * Get Vote
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.votes.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.votes.get API Documentation Enterprise
     */
    public function getVote(int $projectId, int $voteId): ?Vote
    {
        $path = sprintf('projects/%d/votes/%d', $projectId, $voteId);
        return $this->_get($path, Vote::class);
    }

    /**
     * Add Vote
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.votes.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.votes.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[mark] required<br>
     * integer $data[translationId] required
     * @return Vote|null
     */
    public function createVote(int $projectId, array $data): ?Vote
    {
        $path = sprintf('projects/%d/votes', $projectId);
        return $this->_create($path, Vote::class, $data);
    }

    /**
     * Cancel Vote
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.votes.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.votes.delete API Documentation Enterprise
     * @param int $projectId
     * @param int $voteId
     * @return mixed
     */
    public function deleteVote(int $projectId, int $voteId)
    {
        $path = sprintf('projects/%d/votes/%d', $projectId, $voteId);
        return $this->_delete($path);
    }

    /**
     * Approval Batch Operations
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.approvals.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.approvals.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[op] required Patch operation to perform (replace, test)<br>
     * string <json-pointer> $data[path] required A JSON Pointer as defined in RFC 6901<br>
     * value $data[value] required The value to be used within the operation (string, int, bool, or object)
     * @return mixed
     */
    public function approvalsBatchOperations(int $projectId, array $data)
    {
        $path = sprintf('projects/%d/approvals', $projectId);
        return $this->_patch($path, StringTranslationApproval::class, $data);
    }

    /**
     * Translation Batch Operations
     * @link https://developer.crowdin.com/api/v2/#operation/api.projects.translations.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.projects.translations.patch API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * string $data[op] required Patch operation to perform (replace, test)<br>
     * string <json-pointer> $data[path] required A JSON Pointer as defined in RFC 6901<br>
     * value $data[value] required The value to be used within the operation (string, int, bool, or object)
     * @return mixed
     */
    public function translationsBatchOperations(int $projectId, array $data)
    {
        $path = sprintf('projects/%d/translations', $projectId);
        return $this->_patch($path, StringTranslation::class, $data);
    }
}
