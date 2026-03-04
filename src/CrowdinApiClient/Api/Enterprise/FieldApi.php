<?php

namespace CrowdinApiClient\Api\Enterprise;

use CrowdinApiClient\Api\AbstractApi;
use CrowdinApiClient\Model\Enterprise\Field;
use CrowdinApiClient\ModelCollection;

/**
 * Use API to manage custom fields for projects, tasks, users, files, strings, and translations.
 *
 * @package Crowdin\Api\Enterprise
 */
class FieldApi extends AbstractApi
{
    /**
     * List Fields
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.fields.getMany API Documentation
     *
     * @param array $params
     * string $params[search]<br>
     * string $params[entity]<br>
     * string $params[type]<br>
     * integer $params[limit]<br>
     * integer $params[offset]
     * @return ModelCollection
     */
    public function list(array $params = []): ModelCollection
    {
        return $this->_list('fields', Field::class, $params);
    }

    /**
     * Get Field
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.fields.get API Documentation
     *
     * @param int $fieldId
     * @return Field|null
     */
    public function get(int $fieldId): ?Field
    {
        return $this->_get('fields/' . $fieldId, Field::class);
    }

    /**
     * Add Field
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.fields.post API Documentation
     *
     * @param array $data
     * string $data[name] required<br>
     * string $data[slug] required<br>
     * string $data[type] required<br>
     * array $data[entities] required<br>
     * string $data[description]<br>
     * array $data[config]
     * @return Field|null
     */
    public function create(array $data): ?Field
    {
        return $this->_create('fields', Field::class, $data);
    }

    /**
     * Edit Field
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.fields.patch API Documentation
     *
     * @param Field $field
     * @return Field
     */
    public function update(Field $field): Field
    {
        return $this->_update('fields/' . $field->getId(), $field);
    }

    /**
     * Delete Field
     * @link https://developer.crowdin.com/enterprise/api/v2/#operation/api.fields.delete API Documentation
     *
     * @param int $fieldId
     * @return mixed
     */
    public function delete(int $fieldId)
    {
        return $this->_delete('fields/' . $fieldId);
    }
}
