<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\StringTranslation;
use CrowdinApiClient\ModelCollection;

/**
 * Class StringTranslationApi
 * @package Crowdin\Api
 */
class StringTranslationApi extends AbstractApi
{
    /**
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/translations', $projectId);
        return $this->_list($path, StringTranslation::class, $params);
    }

    /**
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
     * @param int $projectId
     * @param array $data
     * @return StringTranslation|null
     */
    public function create(int $projectId, array $data): ?StringTranslation
    {
        $path = sprintf('projects/%d/translations', $projectId);
        return $this->_create($path, StringTranslation::class, $data);
    }

    /**
     * @param int $projectId
     * @param int $translationId
     * @return StringTranslation|null
     */
    public function restore(int $projectId, int $translationId): ?StringTranslation
    {
        $path = sprintf('projects/%d/translations/%d/restore', $projectId, $translationId);

        return $this->_post($path, StringTranslation::class, []);
    }

    /**
     * @param int $projectId
     * @param int $translationId
     * @return mixed
     */
    public function delete(int $projectId, int $translationId)
    {
        $path = sprintf('projects/%d/translations/%d', $projectId, $translationId);
        return $this->_delete($path);
    }
}
