<?php

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\Glossary;
use CrowdinApiClient\Model\GlossaryExport;
use CrowdinApiClient\Model\GlossaryImport;
use CrowdinApiClient\Model\Term;
use CrowdinApiClient\ModelCollection;

/**
 * Glossaries help to explain some specific terms or the ones often used in the project so that they can be properly and consistently translated.
 * Use API to manage glossaries or specific terms.
 * Glossary export and import are asynchronous operations and shall be completed with sequence of API methods.
 *
 * @package Crowdin\Api
 */
class GlossaryApi extends AbstractApi
{
    /**
     * List Glossaries
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.getMany API Documentation Enterprise
     *
     * @param array $params
     * integer $params[groupId]<br>
     * integer $params[limit]<br>
     * integer $params[offset]<br>
     * integer $params[userId]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('glossaries', Glossary::class, $params);
    }

    /**
     * Add Glossary
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.post API Documentation Enterprise
     *
     * @param array $params
     * string $params[name] required<br>
     * integer $params[groupId]
     * @return Glossary|null
     */
    public function create(array $params): ?Glossary
    {
        return $this->_create('glossaries', Glossary::class, $params);
    }

    /**
     * Get Glossary
     * @link https://developer.crowdin.com/api/api/#operation/api.glossaries.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.get API Documentation Enterprise
     *
     * @param int $glossaryId
     * @return Glossary|null
     */
    public function get(int $glossaryId): ?Glossary
    {
        return $this->_get('glossaries/' . $glossaryId, Glossary::class);
    }

    /**
     * Delete Glossary
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.delete API Documentation Enterprise
     *
     * @param int $glossaryId
     * @return mixed
     */
    public function delete(int $glossaryId)
    {
        return $this->_delete('glossaries/' . $glossaryId);
    }

    /**
     * Edit Glossary Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.patch API Documentation Enterprise
     *
     * @param Glossary $glossary
     * @return Glossary|null
     */
    public function update(Glossary $glossary): ?Glossary
    {
        return $this->_update('glossaries/' . $glossary->getId(), $glossary);
    }

    /**
     * Export Glossary
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.exports.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.exports.post API Documentation Enterprise
     *
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

    /**
     * Check Glossary Export Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.exports.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.exports.get API Documentation Enterprise
     *
     * @param int $glossaryId
     * @param string $exportId
     * @return GlossaryExport|null
     */
    public function getExport(int $glossaryId, string $exportId): ?GlossaryExport
    {
        $path = sprintf('glossaries/%d/exports/%s', $glossaryId, $exportId);
        return $this->_get($path, GlossaryExport::class);
    }

	/**
     * Download Glossary
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.exports.download.download API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.exports.download.download API Documentation Enterprise
     *
     * @param int $glossaryId
	 * @param string $exportId
     * @return DownloadFile|null
     */
    public function download(int $glossaryId, string $exportId): ?DownloadFile
    {
        $path = sprintf('glossaries/%d/exports/%s/download', $glossaryId, $exportId);
        return $this->_get($path, DownloadFile::class);
    }

    /**
     * Import Glossary
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.imports.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.imports.post API Documentation
     * @param int $glossaryId
     * @param array $data
     * integer $data[storageId] required<br>
     * array $data[scheme]<br>
     * boolean $data[firstLineContainsHeader]
     * @return GlossaryImport|null
     */
    public function import(int $glossaryId, array $data): ?GlossaryImport
    {
        $path = sprintf('glossaries/%d/imports', $glossaryId);
        return $this->_post($path, GlossaryImport::class, $data);
    }

    /**
     * Check Glossary Import Status
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.imports.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.imports.get API Documentation Enterprise
     *
     * @param int $glossaryId
     * @param string $importId
     * @return GlossaryImport|null
     */
    public function getImport(int $glossaryId, string $importId): ?GlossaryImport
    {
        $path = sprintf('glossaries/%d/imports/%s', $glossaryId, $importId);
        return $this->_get($path, GlossaryImport::class);
    }

    /**
     * List Terms
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.terms.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.terms.getMany API Documentation Enterprise
     *
     * @param int $glossaryId
     * @param array $params
     * integer $params[userId]<br>
     * string $params[languageId]<br>
     * integer $params[translationOfTermId]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection|null
     */
    public function listTerms(int $glossaryId, array $params = []): ?ModelCollection
    {
        $path = sprintf('glossaries/%d/terms', $glossaryId);
        return $this->_list($path, Term::class, $params);
    }

    /**
     * Add Term
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.terms.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.terms.post API Documentation Enterprise
     *
     * @param int $glossaryId
     * @param array $data
     * string $data[languageId] required<br>
     * string $data[text] required<br>
     * string $data[description]<br>
     * string $data[partOfSpeech]<br>
     * integer $data[translationOfTermId]
     * @return mixed
     */
    public function createTerm(int $glossaryId, array $data): ?Term
    {
        $path = sprintf('glossaries/%d/terms', $glossaryId);
        return $this->_create($path, Term::class, $data);
    }

    /**
     * Clear Glossary
     * @link https://developer.crowdin.com/v2/api/#operation/api.glossaries.terms.deleteMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.terms.deleteMany API Documentation Enterprise
     *
     * @param int $glossaryId
     * @return mixed
     */
    public function clearTerms(int $glossaryId)
    {
        $path = sprintf('glossaries/%d/terms', $glossaryId);
        return $this->_delete($path);
    }

    /**
     * Get Term Info
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.terms.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.terms.get API Documentation Enterprise
     *
     * @param int $glossaryId
     * @param int $termId
     * @return Term|null
     */
    public function getTerm(int $glossaryId, int $termId): ?Term
    {
        $path = sprintf('glossaries/%d/terms/%d', $glossaryId, $termId);
        return $this->_get($path, Term::class);
    }

    /**
     * Delete Term
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.terms.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.terms.delete API Documentation Enterprise
     *
     * @param int $glossaryId
     * @param int $termId
     * @return mixed
     */
    public function deleteTerm(int $glossaryId, int $termId)
    {
        $path = sprintf('glossaries/%d/terms/%d', $glossaryId, $termId);
        return $this->_delete($path);
    }

    /**
     * Edit Term
     * @link https://developer.crowdin.com/api/v2/#operation/api.glossaries.terms.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.glossaries.terms.patch API Documentation Enterprise
     * @param Term $term
     * @return Term|null
     */
    public function updateTerm(Term $term): ?Term
    {
        $path = sprintf('glossaries/%d/terms/%d', $term->getGlossaryId(), $term->getId());
        return $this->_update($path, $term);
    }
}
