<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\SourceString;
use CrowdinApiClient\ModelCollection;

/**
 * Class SourceStringApi
 * @package Crowdin\Api
 */
class SourceStringApi extends AbstractApi
{
    /**
     * @param int $projectId
     * @param array $params
     * @return ModelCollection
     */
    public function list(int $projectId, array $params = []): ModelCollection
    {
        $path = sprintf('projects/%d/strings', $projectId);
        return $this->_list($path, SourceString::class, $params);
    }

    /**
     * @param int $projectId
     * @param int $stringId
     * @return SourceString
     */
    public function get(int $projectId, int $stringId): ?SourceString
    {
        $path = sprintf('projects/%d/strings/%d', $projectId, $stringId);
        return $this->_get($path, SourceString::class);
    }

    /**
     * @param int $projectId
     * @param array $data
     * @internal string $data[identifier] required
     * @internal string $data[text] required
     * @internal integer $data[fileId]
     * @internal string $data[context]
     * @internal bool $data[isHidden]
     * @internal integer $data[maxLength]
     * @return SourceString|null
     */
    public function create(int $projectId, array $data): ?SourceString
    {
        $path = sprintf('projects/%d/strings', $projectId);
        return $this->_create($path, SourceString::class, $data);
    }

    /**
     * @param SourceString $sourceString
     * @return SourceString|null
     */
    public function update(SourceString $sourceString): ?SourceString
    {
        $path = sprintf('projects/%d/strings/%d', $sourceString->getProjectId(), $sourceString->getId());
        return $this->_update($path, $sourceString);
    }

    /**
     * @param int $projectId
     * @param int $stringId
     * @return mixed
     */
    public function delete(int $projectId, int $stringId)
    {
        $path = sprintf('projects/%d/strings/%d', $projectId, $stringId);
        return $this->_delete($path);
    }
}
