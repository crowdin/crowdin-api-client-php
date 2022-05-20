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
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.approvals.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.approvals.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @internal integer $params[fileId]  Must be used together with languageId
     * @internal integer $params[stringId] Must be used together with languageId
     * @internal string $params[languageId] Must be used together with stringId or fileId
     * @internal integer $params[translationId] If specified, fileId, stringId and languageId are ignored
     * @internal integer $params[limit]
     * @internal integer $params[offset]
     * @return ModelCollection
     */
    public function listApprovals(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%s/approvals', $projectId);
        return $this->_list($path, StringTranslationApproval::class, $params);
    }

    /**
     * Add Approval
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.approvals.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.approvals.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * @internal integer $data[translationId] required
     * @return StringTranslationApproval|null
     */
    public function createApproval(int $projectId, array $data): ?StringTranslationApproval
    {
        $path = sprintf('projects/%d/approvals', $projectId);

        return $this->_create($path, StringTranslationApproval::class, $data);
    }

    /**
     * Approval Info
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.approvals.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.approvals.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $approvalId
     * @return StringTranslationApproval|null
     */
    public function getApproval(int $projectId, int $approvalId): ?StringTranslationApproval
    {
        $path = sprintf('projects/%d/approvals/%d', $projectId, $approvalId);

        return $this->_get($path, StringTranslationApproval::class);
    }

    /**
     * Remove Approval
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.approvals.delete API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.approvals.delete API Documentation Enterprise
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
     * List Language Translations
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.languages.translations.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.languages.translations.getMany API Documentation Enterprise
     * @param int $projectId
     * @param string $languageId
     * @param array $params
     * @internal string $params[stringIds]
     * @internal int $params[fileId]
     * @internal int $params[denormalizePlaceholders]
     * @internal int $params[limit]
     * @internal int $params[offset]
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
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.getMany  API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.getMany  API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @internal integer $params[stringId] required
     * @internal integer $params[languageId] required
     * @internal integer $params[denormalizePlaceholders]
     * @internal integer $params[limit]
     * @internal integer $params[offset]
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/translations', $projectId);
        return $this->_list($path, StringTranslation::class, $params);
    }

    /**
     * Add Translation
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.add API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.add API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * @internal integer $data[stringId] required
     * @internal integer $data[languageId] required
     * @internal string $data[text] required
     * @internal string $data[pluralCategoryName]
     * @return StringTranslation|null
     */
    public function create(int $projectId, array $data): ?StringTranslation
    {
        $path = sprintf('projects/%d/translations', $projectId);
        return $this->_create($path, StringTranslation::class, $data);
    }

    /**
     * Delete String Translations
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.deleteMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.deleteMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $stringId
     * @param string $languageId
     * @return mixed
     */
    public function deleteStringTranslations(int $projectId, int $stringId, string $languageId)
    {
        $path = sprintf('projects/%d/translations', $projectId);
        $params = [
            'stringId' => $stringId,
            'languageId' => $languageId,
        ];

        return $this->_delete($path, $params);
    }

    /**
     * Get Translation
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $translationId
     * @return StringTranslation|null
     */
    public function get(int $projectId, int $translationId): ?StringTranslation
    {
        $path = sprintf('projects/%d/translations/%d', $projectId, $translationId);
        return $this->_get($path, StringTranslation::class);
    }

    /**
     * Restore Translation
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.put  API Documentation Enterprise
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.put  API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $translationId
     * @return StringTranslation|null
     */
    public function restore(int $projectId, int $translationId): ?StringTranslation
    {
        $path = sprintf('projects/%d/translations/%d', $projectId, $translationId);

        return $this->_put($path, StringTranslation::class, []);
    }

    /**
     * Delete Translation
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.translations.delete API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.translations.delete API Documentation Enterprise
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
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.votes.getMany API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.votes.getMany API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $params
     * @internal integer $params[stringId] Must be used together with languageId
     * @internal string $params[languageId] Must be used together with stringId
     * @internal integer $params[translationId] If specified, stringId and languageId are ignored
     * @internal integer $params[limit]
     * @internal integer $params[offset]
     * @return ModelCollection
     */
    public function listVotes(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/votes', $projectId);
        return $this->_list($path, Vote::class, $params);
    }

    /**
     * Get Vote
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.votes.get API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.votes.get API Documentation Enterprise
     *
     * @param int $projectId
     * @param int $voteId
     * @return Vote|null
     */
    public function getVote(int $projectId, int $voteId): ?Vote
    {
        $path = sprintf('projects/%d/votes/%d', $projectId, $voteId);

        return  $this->_get($path, Vote::class);
    }

    /**
     * Add Vote
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.votes.post API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.votes.post API Documentation Enterprise
     *
     * @param int $projectId
     * @param array $data
     * @internal string $data[mark] required
     * @internal integer $data[translationId] required
     * @return Vote|null
     */
    public function createVote(int $projectId, array $data): ?Vote
    {
        $path = sprintf('projects/%d/votes', $projectId);
        return $this->_create($path, Vote::class, $data);
    }

    /**
     * Cancel Vote
     * @link https://support.crowdin.com/api/v2/#operation/api.projects.votes.delete API Documentation
     * @link https://support.crowdin.com/enterprise/api/#operation/api.projects.votes.delete API Documentation Enterprise
     * @param int $projectId
     * @param int $voteId
     * @return mixed
     */
    public function deleteVote(int $projectId, int $voteId)
    {
        $path = sprintf('projects/%d/votes/%d', $projectId, $voteId);
        return $this->_delete($path);
    }
}
