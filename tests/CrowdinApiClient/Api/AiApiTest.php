<?php

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\AiFileTranslation;
use CrowdinApiClient\Model\AiTranslation;
use CrowdinApiClient\Model\DownloadFile;

class AiApiTest extends AbstractTestApi
{
    public function testTranslateStrings(): void
    {
        $params = [
            'strings' => ['Some text to translate!'],
            'targetLanguageId' => 'uk',
        ];

        $this->mockRequest([
            'path' => '/users/1/ai/translate',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "sourceLanguageId": "en",
                "targetLanguageId": "uk",
                "translations": [
                  "Перекладений текст 1"
                ]
              }
            }',
        ]);

        $aiTranslation = $this->crowdin->ai->translateStrings(1, $params);
        $this->assertInstanceOf(AiTranslation::class, $aiTranslation);
        $this->assertEquals('en', $aiTranslation->getSourceLanguageId());
        $this->assertEquals('uk', $aiTranslation->getTargetLanguageId());
        $this->assertEquals(['Перекладений текст 1'], $aiTranslation->getTranslations());
    }

    public function testCreateFileTranslation(): void
    {
        $params = [
            'storageId' => 123,
            'targetLanguageId' => 'uk',
        ];

        $this->mockRequest([
            'path' => '/users/1/ai/file-translations',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "finished",
                "progress": 100,
                "attributes": {
                  "stage": "done",
                  "error": null,
                  "downloadName": "Sample_Chrome.json",
                  "sourceLanguageId": "en",
                  "targetLanguageId": "uk",
                  "originalFileName": "Sample_Chrome.json",
                  "detectedType": "chrome",
                  "parserVersion": 2
                },
                "createdAt": "2026-01-23T11:26:54+00:00",
                "updatedAt": "2026-01-23T11:26:54+00:00",
                "startedAt": "2026-01-23T11:26:54+00:00",
                "finishedAt": "2026-01-23T11:26:54+00:00"
              }
            }',
        ]);

        $fileTranslation = $this->crowdin->ai->createFileTranslation(1, $params);
        $this->assertInstanceOf(AiFileTranslation::class, $fileTranslation);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $fileTranslation->getIdentifier());
        $this->assertEquals('finished', $fileTranslation->getStatus());
        $this->assertEquals(100, $fileTranslation->getProgress());
        $this->assertEquals('uk', $fileTranslation->getAttributes()['targetLanguageId']);
    }

    public function testGetFileTranslation(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'get',
            'response' => '{
              "data": {
                "identifier": "50fb3506-4127-4ba8-8296-f97dc7e3e0c3",
                "status": "in_progress",
                "progress": 50,
                "attributes": {
                  "stage": "translate",
                  "error": null,
                  "downloadName": null,
                  "sourceLanguageId": "en",
                  "targetLanguageId": "uk",
                  "originalFileName": "Sample_Chrome.json",
                  "detectedType": null,
                  "parserVersion": null
                },
                "createdAt": "2026-01-23T11:26:54+00:00",
                "updatedAt": "2026-01-23T11:26:54+00:00",
                "startedAt": "2026-01-23T11:26:54+00:00",
                "finishedAt": null
              }
            }',
        ]);

        $fileTranslation = $this->crowdin->ai->getFileTranslation(1, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(AiFileTranslation::class, $fileTranslation);
        $this->assertEquals('50fb3506-4127-4ba8-8296-f97dc7e3e0c3', $fileTranslation->getIdentifier());
        $this->assertEquals('in_progress', $fileTranslation->getStatus());
        $this->assertEquals(50, $fileTranslation->getProgress());
    }

    public function testDeleteFileTranslation(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3',
            'method' => 'delete',
            'response' => '',
        ]);

        $this->crowdin->ai->deleteFileTranslation(1, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
    }

    public function testDownloadFileTranslation(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/download',
            'method' => 'get',
            'response' => '{
              "data": {
                "url": "https://example.com/download/file.json",
                "expireIn": "2026-01-23T12:00:00+00:00"
              }
            }',
        ]);

        $downloadFile = $this->crowdin->ai->downloadFileTranslation(1, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://example.com/download/file.json', $downloadFile->getUrl());
        $this->assertEquals('2026-01-23T12:00:00+00:00', $downloadFile->getExpireIn());
    }

    public function testDownloadFileTranslationStrings(): void
    {
        $this->mockRequest([
            'path' => '/users/1/ai/file-translations/50fb3506-4127-4ba8-8296-f97dc7e3e0c3/translations',
            'method' => 'get',
            'response' => '{
              "data": {
                "url": "https://example.com/download/strings.json",
                "expireIn": "2026-01-23T12:00:00+00:00"
              }
            }',
        ]);

        $downloadFile = $this->crowdin->ai->downloadFileTranslationStrings(1, '50fb3506-4127-4ba8-8296-f97dc7e3e0c3');
        $this->assertInstanceOf(DownloadFile::class, $downloadFile);
        $this->assertEquals('https://example.com/download/strings.json', $downloadFile->getUrl());
        $this->assertEquals('2026-01-23T12:00:00+00:00', $downloadFile->getExpireIn());
    }
}
