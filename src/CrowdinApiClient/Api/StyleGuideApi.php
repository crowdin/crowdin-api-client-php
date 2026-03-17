<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Model\StyleGuide;
use CrowdinApiClient\ModelCollection;

class StyleGuideApi extends AbstractApi
{
    /**
     * List Style Guides
     * @link https://developer.crowdin.com/api/v2/#operation/api.style-guides.getMany API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.style-guides.getMany API Documentation Enterprise
     *
     * @param array $params
     * integer $params[limit]<br>
     * integer $params[offset]<br>
     * string $params[orderBy]<br>
     * integer $params[userId]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('style-guides', StyleGuide::class, $params);
    }

    /**
     * Add Style Guide
     * @link https://developer.crowdin.com/api/v2/#operation/api.style-guides.post API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.style-guides.post API Documentation Enterprise
     *
     * @param array $params
     * string $params[name] required<br>
     * int $params[storageId] required<br>
     * string|null $params[aiInstructions]<br>
     * string[] $params[languageIds]<br>
     * int[] $params[projectIds]<br>
     * bool $params[isShared]
     * @return StyleGuide|null
     */
    public function create(array $params): ?StyleGuide
    {
        return $this->_create('style-guides', StyleGuide::class, $params);
    }

    /**
     * Get Style Guide
     * @link https://developer.crowdin.com/api/v2/#operation/api.style-guides.get API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.style-guides.get API Documentation Enterprise
     *
     * @param int $styleGuideId
     * @return StyleGuide|null
     */
    public function get(int $styleGuideId): ?StyleGuide
    {
        return $this->_get('style-guides/' . $styleGuideId, StyleGuide::class);
    }

    /**
     * Delete Style Guide
     * @link https://developer.crowdin.com/api/v2/#operation/api.style-guides.delete API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.style-guides.delete API Documentation Enterprise
     *
     * @param int $styleGuideId
     * @return mixed
     */
    public function delete(int $styleGuideId)
    {
        return $this->_delete('style-guides/' . $styleGuideId);
    }

    /**
     * Edit Style Guide
     * @link https://developer.crowdin.com/api/v2/#operation/api.style-guides.patch API Documentation
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.style-guides.patch API Documentation Enterprise
     *
     * @param StyleGuide $styleGuide
     * @return StyleGuide|null
     */
    public function update(StyleGuide $styleGuide): ?StyleGuide
    {
        return $this->_update('style-guides/' . $styleGuide->getId(), $styleGuide);
    }
}
