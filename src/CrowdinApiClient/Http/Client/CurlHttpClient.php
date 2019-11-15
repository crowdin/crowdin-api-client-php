<?php

namespace CrowdinApiClient\Http\Client;

use CrowdinApiClient\Exceptions\HttpException;

/**
 * Class CurlClient
 * @package Crowdin\Http\Client
 */
class CurlHttpClient implements CrowdinHttpClientInterface
{

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @throws HttpException
     * @return mixed
     * @internal param array $body
     * @internal param array $headers
     */
    public function request(string $method, string $uri, array $options)
    {
        if (empty($method)) {
            throw new \InvalidArgumentException('Method cannot be empty');
        }

        if (empty($uri)) {
            throw new \InvalidArgumentException('Uri cannot be empty');
        }

        $headers = $options['headers'] ?? [];
        $body = $options['body'] ?? null;

        $processed_headers = [];
        if (!empty($headers)) {
            foreach ($headers as $key => $value) {
                $processed_headers[] = $key . ': ' . $value;
            }
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $processed_headers);

        if (strtolower($method) === 'post') {
            curl_setopt($ch, CURLOPT_POST, true);

            if ($body && is_array($body)) {
                $body = http_build_query($body, '', '&');
            }

            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        } else {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }

        $response = curl_exec($ch);

        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (false === $response) {
            $errNo = curl_errno($ch);
            $errStr = curl_error($ch);
            curl_close($ch);

            if (empty($errStr)) {
                throw new HttpException('There was a problem requesting the resource.', $responseCode);
            }

            throw new HttpException($errStr . '(cURL Error: ' . $errNo . ')', $responseCode);
        }

        curl_close($ch);

        return $response;
    }
}
