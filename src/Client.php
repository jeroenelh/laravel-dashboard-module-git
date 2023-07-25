<?php

namespace Microit\DashboardModuleGit;

use Exception;

class Client
{
    /**
     * @var array<string, string>
     */
    protected array $headers = [];

    public function __construct(private readonly string $api)
    {
    }

    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    /**
     * @param string $uri
     * @return object|array|string
     * @throws Exception
     */
    public function request(string $uri): object|array|string
    {
        $curl = curl_init(sprintf('%s%s', $this->api, $uri));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, __CLASS__);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);

        $curlResponse = curl_exec($curl);
        curl_close($curl);

        if (! $curlResponse) {
            throw new Exception('No response message received');
        }

        $headerSize = (int) curl_getinfo($curl, CURLINFO_HEADER_SIZE);

        return $this->processResponse((string) $curlResponse, $headerSize);
    }

    /**
     * @param string $response
     * @param int $headerSize
     * @return array<array-key, mixed>|object|string
     * @throws \Exception
     */
    private function processResponse(string $response, int $headerSize): object|array|string
    {
        $headers = $this->getHeaders(substr($response, 0, $headerSize));

        // Check JSON
        if (isset($headers['content-type']) && str_contains((string) $headers['content-type'], 'application/json')) {
            $json = json_decode(substr($response, $headerSize));
            assert(is_object($json) || is_array($json));

            return $json;
        }

        throw new Exception('Error handling response. Unknown content type');
    }

    private function getHeaders(string $headerInfo): array
    {
        $headers = [];
        foreach (explode("\r\n", $headerInfo) as $headerLine) {
            $headerLine = explode(':', $headerLine);
            if (count($headerLine) == 2) {
                $headers[trim($headerLine[0])] = trim($headerLine[1]);
            }
        }

        return $headers;
    }
}
