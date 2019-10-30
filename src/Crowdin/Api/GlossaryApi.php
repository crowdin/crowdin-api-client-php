<?php

namespace Crowdin\Api;

use Crowdin\Model\DownloadFile;
use Crowdin\Model\Glossary;

/**
 * Class GlossaryApi
 * @package Crowdin\Api
 */
class GlossaryApi extends AbstractApi
{
    public function list()
    {
        return $this->_list('glossaries', Glossary::class);
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
     * @param array $data
     * @return mixed
     */
    public function create(array $data): ?Glossary
    {
        return $this->_create('glossaries', Glossary::class, $data);
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
}
