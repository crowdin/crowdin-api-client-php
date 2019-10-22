<?php


namespace Crowdin\Http\Client;


use Crowdin\Exceptions\HttpException;

class CurlClient implements CrowdinHttpClientInterface
{

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @return mixed
     * @throws HttpException
     * @internal param array $body
     * @internal param array $headers
     */
    public function request(string $method, string $uri, array $options)
    {
        $headers = $options['headers'];
        $body = $options['body'];

        $processed_headers = array();
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

        var_dump($uri);
        var_dump($processed_headers);

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
