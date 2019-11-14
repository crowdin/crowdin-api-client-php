<?php

namespace Crowdin\Api;

use Crowdin\Model\DownloadFile;
use Crowdin\Model\Glossary;
use Crowdin\Model\GlossaryExport;

/**
 * Class GlossaryApi
 * @package Crowdin\Api
 */
class GlossaryApi extends AbstractApi
{
    /**
     * @param array $params
     * @return mixed
     */
    public function list(array $params = [])
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
     * @param string $name
     * @param int $groupId
     * @return Glossary|null
     */
    public function create(string $name, int $groupId = 0): ?Glossary
    {
        $params = [
            'name' => $name,
            'groupId' => $groupId
        ];
        return $this->_create('glossaries', Glossary::class, $params);
    }

    /**
     * @param Glossary $glossary
     * @return Glossary|null
     */
    public function update(Glossary $glossary): ?Glossary
    {
        return $this->_update('glossaries', $glossary);
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
    public function export(int $glossaryId, $format = 'tbx'):?GlossaryExport
    {
        $path = sprintf('glossaries/%d/exports', $glossaryId);
        $params = ['format' => $format];

        return $this->_post($path, GlossaryExport::class, $params);
    }
}
