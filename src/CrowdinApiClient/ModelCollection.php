<?php

namespace CrowdinApiClient;

/**
 * @package CrowdinApiClient
 */
class ModelCollection extends Collection
{
    /**
     * @var array
     */
    protected $pagination = [];

    public function getPagination(): array
    {
        return $this->pagination;
    }

    public function setPagination(array $pagination): void
    {
        $this->pagination = $pagination;
    }
}
