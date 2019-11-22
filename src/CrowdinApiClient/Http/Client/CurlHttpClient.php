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
     * @var int
     */
    protected $timeout = 60;

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

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

        $processedHeaders = [];
        if (!empty($headers)) {
            foreach ($headers as $key => $value) {
                $processedHeaders[] = $key . ': ' . $value;
            }
        }

        $ch = $this->curlInit();

        $this->curlSetUrl($ch, $uri);
        $this->curlSetOption($ch, CURLOPT_TIMEOUT, $this->timeout);
        $this->curlSetOption($ch, CURLOPT_RETURNTRANSFER, true);
        $this->curlSetOption($ch, CURLOPT_HEADER, false);
        $this->curlSetOption($ch, CURLOPT_HTTPHEADER, $processedHeaders);

        if (strtolower($method) === 'post') {
            $this->curlSetOption($ch, CURLOPT_POST, true);

            if ($body && is_array($body)) {
                $body = http_build_query($body, '', '&');
            }

            $this->curlSetOption($ch, CURLOPT_POSTFIELDS, $body);
        } else {
            $this->curlSetOption($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
            $this->curlSetOption($ch, CURLOPT_POSTFIELDS, $body);
        }

        $response = $this->curlExec($ch);

        $responseCode = $this->curlGetInfo($ch);

        if (false === $response) {
            $errNo = $this->curlErrno($ch);
            $errStr = $this->curlError($ch);
            $this->curlClose($ch);

            if (empty($errStr)) {
                throw new HttpException('There was a problem requesting the resource.', $responseCode);
            }

            throw new HttpException($errStr . '(cURL Error: ' . $errNo . ')', $responseCode);
        }

        $this->curlExec($ch);

        return $response;
    }

    public function curlError($ch)
    {
        return curl_error($ch);
    }

    public function curlErrno($ch)
    {
        return curl_errno($ch);
    }

    public function curlClose($ch)
    {
        return curl_close($ch);
    }

    /**
     * @param $ch
     * @return bool|string
     */
    public function curlExec($ch)
    {
        return curl_exec($ch);
    }

    /**
     * @param $ch
     * @return mixed
     */
    public function curlGetInfo($ch)
    {
        return curl_getinfo($ch, CURLINFO_HTTP_CODE);
    }

    /**
     * @param $ch
     * @param $option
     * @param $value
     * @return bool
     */
    public function curlSetOption($ch, $option, $value): bool
    {
        return curl_setopt($ch, $option, $value);
    }

    /***
     * @return false|resource
     */
    public function curlInit()
    {
        return curl_init();
    }

    /**
     * @param $ch
     * @param $uri
     * @return bool
     */
    public function curlSetUrl($ch, $uri): bool
    {
        return curl_setopt($ch, CURLOPT_URL, $uri);
    }
}
