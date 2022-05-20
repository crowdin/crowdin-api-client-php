<?php

namespace CrowdinApiClient;

/**
 * @internal
 * Class ModelCollection
 * @package CrowdinApiClient
 */
class ModelCollection extends Collection
{
    /**
     * @var array
     */
    protected $pagination = [];

    /**
     * @return array
     */
    public function getPagination(): array
    {
        return $this->pagination;
    }

    /**
     * @param array $pagination
     */
    public function setPagination(array $pagination): void
    {
        $this->pagination = $pagination;
    }
}
