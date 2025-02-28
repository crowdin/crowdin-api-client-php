<?php

declare(strict_types=1);

namespace CrowdinApiClient\Api;

use CrowdinApiClient\Http\ResponseDecorator\ResponseArrayDecorator;

/**
 * GraphQL API is a tool that allows you to retrieve exactly the data you need using more specific and flexible queries.
 *
 * @package Crowdin\Api
 */
class GraphqlApi extends AbstractApi
{
    /**
     * GraphQL Query
     *
     * @link https://support.crowdin.com/developer/graphql-api/
     */
    public function query(string $query, ?string $operationName = null, ?array $variables = null): array
    {
        $options = [
            'body' => json_encode([
                'query' => $query,
                'operationName' => $operationName,
                'variables' => $variables,
            ]),
            'headers' => array_merge(
                ['Authorization' => 'Bearer ' . $this->client->getAccessToken()],
                $this->getHeaders()
            ),
        ];

        $response = $this->client->getClient()->request('post', $this->getFullUrl(), $options);
        $response = json_decode($response, true);

        $this->client->getResponseErrorHandler()->check($response);

        return (new ResponseArrayDecorator())->decorate($response['data']);
    }

    private function getFullUrl(): string
    {
        if ($this->client->isEnterprise()) {
            return sprintf('https://%s.api.crowdin.com/api/graphql', $this->client->getOrganization());
        }

        return 'https://api.crowdin.com/api/graphql';
    }
}
