<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Glossary;
use CrowdinApiClient\Model\GlossaryExport;
use CrowdinApiClient\ModelCollection;

/**
 * Class GlossaryApi
 * @package Crowdin\Api
 */
class GlossaryApi extends AbstractApi
{
    /**
     * @param array $params
     * @internal integer $params[limit]
     * @internal integer $params[offset]
     * @internal integer $params[userId]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('glossaries', Glossary::class, $params);
    }

    /**
     * @param int $glossaryId
     * @return Glossary|null
     */
    public function get(int $glossaryId): ?Glossary
    {
        return $this->_get('glossaries/' . $glossaryId, Glossary::class);
    }

    /**
     * @param array $params
     * @return Glossary|null
     */
    public function create(array $params): ?Glossary
    {
        return $this->_create('glossaries', Glossary::class, $params);
    }

    /**
     * @param Glossary $glossary
     * @return Glossary|null
     */
    public function update(Glossary $glossary): ?Glossary
    {
        return $this->_update('glossaries/' . $glossary->getId(), $glossary);
    }

    /**
     * @param int $glossaryId
     * @return DownloadFile|null
     */
    public function download(int $glossaryId): ?DownloadFile
    {
        $path = sprintf('glossaries/%d/exports/download', $glossaryId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * @param int $glossaryId
     * @return mixed
     */
    public function delete(int $glossaryId)
    {
        return $this->_delete('glossaries/' . $glossaryId);
    }

    /**
     * @param int $glossaryId
     * @param string $format
     * @return GlossaryExport|null
     */
    public function export(int $glossaryId, $format = 'tbx'): ?GlossaryExport
    {
        $path = sprintf('glossaries/%d/exports', $glossaryId);
        $params = ['format' => $format];

        return $this->_post($path, GlossaryExport::class, $params);
    }
}
