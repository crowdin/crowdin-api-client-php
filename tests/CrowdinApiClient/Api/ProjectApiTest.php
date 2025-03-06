<?php

declare(strict_types=1);

namespace CrowdinApiClient\Tests\Api;

use CrowdinApiClient\Model\DownloadFile;
use CrowdinApiClient\Model\FileFormatSettings;
use CrowdinApiClient\Model\Project;
use CrowdinApiClient\ModelCollection;

class ProjectApiTest extends AbstractTestApi
{
    public function testList(): void
    {
        $this->mockRequest([
            'path' => '/projects',
            'method' => 'get',
            'response' => json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 8,
                            'userId' => 6,
                            'sourceLanguageId' => 'uk',
                            'targetLanguageIds' => ['es'],
                            'languageAccessPolicy' => 'moderate',
                            'name' => 'Knowledge Base',
                            'cname' => 'my-custom-domain.crowdin.com',
                            'identifier' => '1f198a4e907688bc65834a6d5a6000c3',
                            'description' => 'Vault of all terms and their explanation',
                            'visibility' => 'private',
                            'logo' => 'data:image/png;base64,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',
                            'createdAt' => '2019-09-20T11:34:40+00:00',
                            'updatedAt' => '2019-09-20T11:34:40+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    [
                        'offset' => 0,
                        'limit' => 0,
                    ],
                ],
            ]),
        ]);

        $projects = $this->crowdin->project->list();

        $this->assertInstanceOf(ModelCollection::class, $projects);
        $this->assertCount(1, $projects);
        $this->assertInstanceOf(Project::class, $projects[0]);
        $this->assertEquals(8, $projects[0]->getId());
    }

    public function testCreate(): void
    {
        $params = [
            'name' => 'Knowledge Base',
            'identifier' => '1f198a4e907688bc65834a6d5a6000c3',
            'type' => 1,
            'sourceLanguageId' => 'uk',
            'targetLanguageIds' => [
                0 => 'es',
            ],
            'visibility' => 'private',
            'languageAccessPolicy' => 'moderate',
            'cname' => 'my-custom-domain.crowdin.com',
            'description' => 'Articles and tutorials',
            'qaCheckIsActive' => true,
            'qaCheckCategories' => [
                'empty' => true,
                'size' => true,
                'tags' => true,
                'spaces' => true,
                'variables' => true,
                'punctuation' => true,
                'symbolRegister' => true,
                'specialSymbols' => true,
                'wrongTranslation' => true,
                'spellcheck' => true,
                'icu' => true,
            ],
            'qaChecksIgnorableCategories' => [
                'empty' => false,
                'size' => true,
                'tags' => true,
                'spaces' => true,
                'variables' => true,
                'punctuation' => true,
                'symbolRegister' => true,
                'specialSymbols' => true,
                'wrongTranslation' => true,
                'spellcheck' => true,
                'icu' => false,
                'terms' => true,
                'duplicate' => false,
                'ftl' => false,
                'android' => true,
            ],
        ];

        $this->mockRequest([
            'path' => '/projects',
            'method' => 'post',
            'body' => json_encode($params),
            'response' => json_encode([
                'data' => [
                    'id' => 8,
                    'userId' => 6,
                    'sourceLanguageId' => 'uk',
                    'targetLanguageIds' => ['es'],
                    'targetLanguages' => [
                        [
                            'id' => 'es',
                            'name' => 'Spanish',
                            'editorCode' => 'es',
                            'twoLettersCode' => 'es',
                            'threeLettersCode' => 'spa',
                            'locale' => 'es-ES',
                            'androidCode' => 'es-rES',
                            'osxCode' => 'es.lproj',
                            'osxLocale' => 'es',
                            'pluralCategoryNames' => [],
                            'pluralRules' => '(n != 1)',
                            'pluralExamples' => [],
                            'textDirection' => 'ltr',
                            'dialectOf' => 'string',
                        ],
                    ],
                    'languageAccessPolicy' => 'moderate',
                    'name' => 'Knowledge Base',
                    'cname' => 'my-custom-domain.crowdin.com',
                    'identifier' => '1f198a4e907688bc65834a6d5a6000c3',
                    'description' => 'Vault of all terms and their explanation',
                    'visibility' => 'private',
                    'logo' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWCAYAAAA8AXHiAAAGm0lEQVR4nO3cWVCVdRjH8R+HTQQR93BJo1Jz1MrRSS21JDUNRWUxMabVpvXcNuNdl100U2qNuQ+KIiCCCIqYoSPkbiippCKiuBDKvp6FLmzG8Pxf1vO858D7+1z6vA7PMN85Oud//scj0rymBUROZnL1AtQ7MSwSwbBIBMMiEQyLRDAsEsGwSATDIhEMi0QwLBLBsEgEwyIRDItEMCwSwbBIBMMiEQyLRDAsEsGwSATDIhEMi0QwLBLBsEgEwyIRDItEMCwSwbBIBMMiEQyLRDAsEsGwSATDIhEMi0QwLBLBsEiEl6sXkLThu2+Vfx6Xmom8C5fEfu7bM6Yh8p25ytmjyip8v3knqmpqxX6+O+ArlpNNmzQBy+e/pZzV1tXjx7g9vT4qgGE51fiQ0fhg6SKYTB4Os8amZqyPT0bZwwoXbKY/huUko4KH4fP3lsPLy9NhZrXa8OuefSguveeCzVyDYTnBkIFB+Ob9KPTx9XGY2e0t2L4vA1duFOu/mAsxrG7q598X5tgVCAzwV84TDx7B2YIrOm/legyrG3x9vGGOjcaQgUHKecaxXOScPq/zVu6BYXWRyeSBL1ZGYFTwMOX8+Nk/kX70hM5buQ+G1UUfRyzG+JDRytn5y4XYfSBL543cC8PqguiFoZg68SXlrPBmCbYk70dLi85LuRmG1UkL3piOudOnKmcld+/jl13JsNnsOm/lfhhWJ0x/eSKWzZujnJU9rMC6nUloarbovJV7YlgdNPHFEMSGL1TOqmpq8VNcAmrq6nXeyn0xrA4YMyIYn0Uvhaen46+rvqERa3ck4mFltQs2c18Mqx1DBw3A16si4ePj7TCzWKz4eddelD74xwWbuTeG1YbAAH+YY1cgwL+vw8xms2NTUhpulNxxwWbuj2Fp6OPrA3NsNAYP6K+cx6cfwsXC6zpv1XMwLAVPTxO+jInAyGeGKuf7so+JflCwN2BYCp9ELsHYMc8qZ0f+OIOsEyd13qjnYVhPWRk2H1MmjFPOTuYXIPnQUZ036pkY1v8smj0Tc6a9qpwVXCtCXGqmzhv1XAzrP69PmYwlobOUs6LbpdiQkAK73eAHgJ3AsABMHvcCYsIWKGd3y8qxbmcSrFabzlv1bIYPK2TUCKyOCle+q15ZXYO1OxLR0Njkgs16NkOHFTxkEL6KiYC3t/p6pa+PDzwVN26ofYYNKyiwH8yx0fDv66f5jF8fX3waFa68zkVtM2RY/n5+MMdGY0D/wHaffW7kcISHztZhq97FkGEtmTsLw4cO7vDz82a+pvkxZFIzZFiq/1MVl95D0e1S5fMmkwc+Wh7W5j+b1Johw3ra5es38cO2XdiUtB919Q3KZ/r3C8CHy97VebOey/BhncwvwPr4JFgsVlRUVSMu7aDms5PGPo9Qjc+7U2uGDutw7ilsT8lo9Y56/tVr+P3UOc2/s2zem5qfeqAnDBmW3d6CPZlHkHI4RzlPzjqKkrv3lTMvL0+sjgrXfO+LHjNkWBk5uW2+KtlsdmxMTNV8x33Y4IGICZsvtV6vYMiwKqrbv/hQXlGF+HTt28wzXpmkeWmVDBpWR50tuIIT5/I156sWL8CgoPbfZDUihtWOhMxszVs4PPLRxrDaYbXasDExFc0aN5x55KPGsDrgQfkjJGRma8555OOIYXVQ3oVLOH3xL+WMRz6OGFYn7Nh/CA/KHylnPPJpjWF1gsVixaakNFgsVuWcRz5PMKxOunO/DMlZ2lfAeOTzGMPqgmNnLuD85ULljEc+jzGsLopLzUR5RZVyxiMfhtVljU3N2JyUpnktzOhHPgyrG4pL7yHtt+OacyMf+TCsbsrOO41Lf99Qzox85MOwnGBbygFUVtcoZ0Y98mFYTlDf0IgtyemaX8NtxCMfhuUk127dRkZOrnJmxCMfhuVEmcfzcLXolnJmtCMfhuVkW/emo7q2Tjkz0pEPw3Ky6to6bN2brvldWkY58mFYAq4W3cLhXPX3lBrlyMcj0ryGX1NHTsdXLBLBsEgEwyIRDItEMCwSwbBIBMMiEQyLRDAsEsGwSATDIhEMi0QwLBLBsEgEwyIRDItEMCwSwbBIBMMiEQyLRDAsEsGwSATDIhEMi0QwLBLBsEgEwyIRDItEMCwSwbBIBMMiEQyLRDAsEsGwSATDIhEMi0QwLBLBsEgEwyIRDItEMCwSwbBIBMMiEQyLRDAsEsGwSMS//tClrE3peLcAAAAASUVORK5CYII=',
                    'hiddenStringsProofreadersAccess' => true,
                    'inContextProcessHiddenStrings' => false,
                    'glossaryAccess' => true,
                    'normalizePlaceholder' => false,
                    'saveMetaInfoInSource' => true,
                    'notificationSettings' => [
                        'translatorNewStrings' => 'false',
                        'managerNewStrings' => 'false',
                        'managerLanguageCompleted' => 'false',
                    ],
                    'qaCheckIsActive' => true,
                    'qaCheckCategories' => [
                        'empty' => 'true',
                        'size' => 'true',
                        'tags' => 'true',
                        'spaces' => 'true',
                        'variables' => 'true',
                        'punctuation' => 'true',
                        'symbolRegister' => 'true',
                        'specialSymbols' => 'true',
                        'wrongTranslation' => 'true',
                        'spellcheck' => 'true',
                        'icu' => 'true',
                    ],
                    'qaChecksIgnorableCategories' => [
                        'empty' => 'false',
                        'size' => 'true',
                        'tags' => 'true',
                        'spaces' => 'true',
                        'variables' => 'true',
                        'punctuation' => 'true',
                        'symbolRegister' => 'true',
                        'specialSymbols' => 'true',
                        'wrongTranslation' => 'true',
                        'spellcheck' => 'true',
                        'icu' => 'false',
                        'terms' => 'true',
                        'duplicate' => 'false',
                        'ftl' => 'false',
                        'android' => 'true',
                    ],
                    'createdAt' => '2019-09-20T11:34:40+00:00',
                    'updatedAt' => '2019-09-20T11:34:40+00:00',
                ],
            ]),
        ]);

        $project = $this->crowdin->project->create($params);

        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals(8, $project->getId());
        $this->assertEquals('es', $project->getTargetLanguageIds()[0]);
        $this->assertEquals('1f198a4e907688bc65834a6d5a6000c3', $project->getIdentifier());
    }

    public function testInfoGetAndUpdate(): void
    {
        $this->mockRequestGet(
            '/projects/8',
            json_encode([
                'data' => [
                    'id' => 8,
                    'userId' => 6,
                    'sourceLanguageId' => 'uk',
                    'targetLanguageIds' => ['es'],
                    'targetLanguages' => [
                        [
                            'id' => 'es',
                            'name' => 'Spanish',
                            'editorCode' => 'es',
                            'twoLettersCode' => 'es',
                            'threeLettersCode' => 'spa',
                            'locale' => 'es-ES',
                            'androidCode' => 'es-rES',
                            'osxCode' => 'es.lproj',
                            'osxLocale' => 'es',
                            'pluralCategoryNames' => [],
                            'pluralRules' => '(n != 1)',
                            'pluralExamples' => [],
                            'textDirection' => 'ltr',
                            'dialectOf' => 'string',
                        ],
                    ],
                    'languageAccessPolicy' => 'moderate',
                    'name' => 'Knowledge Base',
                    'cname' => 'my-custom-domain.crowdin.com',
                    'identifier' => '1f198a4e907688bc65834a6d5a6000c3',
                    'description' => 'Vault of all terms and their explanation',
                    'visibility' => 'private',
                    'logo' => 'data:image/png;base64,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',
                    'hiddenStringsProofreadersAccess' => true,
                    'inContextProcessHiddenStrings' => false,
                    'glossaryAccess' => true,
                    'normalizePlaceholder' => false,
                    'saveMetaInfoInSource' => true,
                    'notificationSettings' => [
                        'translatorNewStrings' => 'false',
                        'managerNewStrings' => 'false',
                        'managerLanguageCompleted' => 'false',
                    ],
                    'qaCheckIsActive' => true,
                    'qaCheckCategories' => [
                        'empty' => 'true',
                        'size' => 'true',
                        'tags' => 'true',
                        'spaces' => 'true',
                        'variables' => 'true',
                        'punctuation' => 'true',
                        'symbolRegister' => 'true',
                        'specialSymbols' => 'true',
                        'wrongTranslation' => 'true',
                        'spellcheck' => 'true',
                        'icu' => 'true',
                    ],
                    'qaChecksIgnorableCategories' => [
                        'empty' => 'false',
                        'size' => 'true',
                        'tags' => 'true',
                        'spaces' => 'true',
                        'variables' => 'true',
                        'punctuation' => 'true',
                        'symbolRegister' => 'true',
                        'specialSymbols' => 'true',
                        'wrongTranslation' => 'true',
                        'spellcheck' => 'true',
                        'icu' => 'false',
                        'terms' => 'true',
                        'duplicate' => 'false',
                        'ftl' => 'false',
                        'android' => 'true',
                    ],
                    'createdAt' => '2019-09-20T11:34:40+00:00',
                    'updatedAt' => '2019-09-20T11:34:40+00:00',
                ],
            ])
        );

        $project = $this->crowdin->project->get(8);

        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals(8, $project->getId());

        $project->setName('edit test');

        $this->mockRequestPatch(
            '/projects/8',
            json_encode([
                'data' => [
                    'id' => 8,
                    'userId' => 6,
                    'sourceLanguageId' => 'uk',
                    'targetLanguageIds' => ['es'],
                    'targetLanguages' => [
                        [
                            'id' => 'es',
                            'name' => 'Spanish',
                            'editorCode' => 'es',
                            'twoLettersCode' => 'es',
                            'threeLettersCode' => 'spa',
                            'locale' => 'es-ES',
                            'androidCode' => 'es-rES',
                            'osxCode' => 'es.lproj',
                            'osxLocale' => 'es',
                            'pluralCategoryNames' => [],
                            'pluralRules' => '(n != 1)',
                            'pluralExamples' => [],
                            'textDirection' => 'ltr',
                            'dialectOf' => 'string',
                        ],
                    ],
                    'languageAccessPolicy' => 'moderate',
                    'name' => 'edit test',
                    'identifier' => '1f198a4e907688bc65834a6d5a6000c3',
                    'description' => 'Vault of all terms and their explanation',
                    'visibility' => 'private',
                    'logo' => 'data:image/png;base64,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',
                    'hiddenStringsProofreadersAccess' => true,
                    'inContextProcessHiddenStrings' => false,
                    'glossaryAccess' => true,
                    'normalizePlaceholder' => false,
                    'saveMetaInfoInSource' => true,
                    'notificationSettings' => [
                        'translatorNewStrings' => 'false',
                        'managerNewStrings' => 'false',
                        'managerLanguageCompleted' => 'false',
                    ],
                    'qaCheckIsActive' => true,
                    'qaCheckCategories' => [
                        'empty' => 'true',
                        'size' => 'true',
                        'tags' => 'true',
                        'spaces' => 'true',
                        'variables' => 'true',
                        'punctuation' => 'true',
                        'symbolRegister' => 'true',
                        'specialSymbols' => 'true',
                        'wrongTranslation' => 'true',
                        'spellcheck' => 'true',
                        'icu' => 'true',
                    ],
                    'qaChecksIgnorableCategories' => [
                        'empty' => 'false',
                        'size' => 'true',
                        'tags' => 'true',
                        'spaces' => 'true',
                        'variables' => 'true',
                        'punctuation' => 'true',
                        'symbolRegister' => 'true',
                        'specialSymbols' => 'true',
                        'wrongTranslation' => 'true',
                        'spellcheck' => 'true',
                        'icu' => 'false',
                        'terms' => 'true',
                        'duplicate' => 'false',
                        'ftl' => 'false',
                        'android' => 'true',
                    ],
                    'createdAt' => '2019-09-20T11:34:40+00:00',
                    'updatedAt' => '2019-09-20T11:34:40+00:00',
                ],
            ])
        );

        $project = $this->crowdin->project->update($project);

        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals(8, $project->getId());
        $this->assertEquals('edit test', $project->getName());
    }

    public function testDelete(): void
    {
        $this->mockRequestDelete('/projects/1');
        $this->crowdin->project->delete(1);
    }

    public function testDownloadFileFormatSettingsCustomSegmentation(): void
    {
        $this->mockRequestGet(
            '/projects/8/file-format-settings/10/custom-segmentations',
            json_encode([
                'data' => [
                    'url' => 'https://crowdin-importer.downloads.crowdin.com/29720421/750373/file_format_srx/test.srx',
                    'expireIn' => '2025-03-03T15:02:23+00:00',
                ],
            ])
        );

        $file = $this->crowdin->project->downloadFileFormatSettingsCustomSegmentation(8, 10);

        $this->assertInstanceOf(DownloadFile::class, $file);
        $this->assertSame(
            'https://crowdin-importer.downloads.crowdin.com/29720421/750373/file_format_srx/test.srx',
            $file->getUrl()
        );
        $this->assertSame('2025-03-03T15:02:23+00:00', $file->getExpireIn());
    }

    public function testResetFileFormatSettingsCustomSegmentation(): void
    {
        $this->mockRequestDelete('/projects/8/file-format-settings/10/custom-segmentations');
        $this->crowdin->project->resetFileFormatSettingsCustomSegmentation(8, 10);
    }

    public function testListFileFormatSettings(): void
    {
        $this->mockRequestGet(
            '/projects/8/file-format-settings',
            json_encode([
                'data' => [
                    [
                        'data' => [
                            'id' => 22,
                            'name' => 'Android XML',
                            'format' => 'android',
                            'extensions' => [
                                'xml',
                            ],
                            'settings' => [
                                'exportPattern' => 'android.xml',
                                'contentSegmentation' => true,
                                'customSegmentation' => false,
                            ],
                            'createdAt' => '2025-03-03T14:57:11+00:00',
                            'updatedAt' => '2025-03-03T15:01:19+00:00',
                        ],
                    ],
                ],
                'pagination' => [
                    'offset' => 0,
                    'limit' => 1,
                ],
            ])
        );

        $list = $this->crowdin->project->listFileFormatSettings(8);

        $this->assertInstanceOf(ModelCollection::class, $list);
        $this->assertInstanceOf(FileFormatSettings::class, $list[0]);
        $this->assertSame('android', $list[0]->getFormat());
        $this->assertSame('android.xml', $list[0]->getSettings()['exportPattern']);
    }

    public function testCreateFileFormatSettings(): void
    {
        $this->mockRequestPost(
            '/projects/8/file-format-settings',
            json_encode([
                'format' => 'android',
                'settings' => [
                    'srxStorageId' => 100500,
                    'exportPattern' => 'android.xml',
                ],
            ]),
            json_encode([
                'data' => [
                    'id' => 24,
                    'name' => 'Android XML',
                    'format' => 'android',
                    'extensions' => [
                        'xml',
                    ],
                    'settings' => [
                        'exportPattern' => 'android.xml',
                        'customSegmentation' => true,
                    ],
                    'createdAt' => '2025-03-03T15:36:18+00:00',
                    'updatedAt' => '2025-03-03T15:36:18+00:00',
                ],
            ])
        );

        $fileFormatSettings = $this->crowdin->project->createFileFormatSettings(
            8,
            [
                'format' => 'android',
                'settings' => [
                    'srxStorageId' => 100500,
                    'exportPattern' => 'android.xml',
                ],
            ]
        );

        $this->assertInstanceOf(FileFormatSettings::class, $fileFormatSettings);
        $this->assertSame('android', $fileFormatSettings->getFormat());
        $this->assertSame(true, $fileFormatSettings->getSettings()['customSegmentation']);
    }

    public function testGetFileFormatSettings(): void
    {
        $this->mockRequestGet(
            '/projects/8/file-format-settings/10',
            json_encode([
                'data' => [
                    'id' => 24,
                    'name' => 'Android XML',
                    'format' => 'android',
                    'extensions' => [
                        'xml',
                    ],
                    'settings' => [
                        'exportPattern' => 'android.xml',
                    ],
                    'createdAt' => '2025-03-03T15:36:18+00:00',
                    'updatedAt' => '2025-03-03T15:36:18+00:00',
                ],
            ])
        );

        $fileFormatSettings = $this->crowdin->project->getFileFormatSettings(8, 10);

        $this->assertInstanceOf(FileFormatSettings::class, $fileFormatSettings);
        $this->assertSame('android', $fileFormatSettings->getFormat());
    }

    public function testDeleteFileFormatSettings(): void
    {
        $this->mockRequestDelete('/projects/8/file-format-settings/10');
        $this->crowdin->project->deleteFileFormatSettings(8, 10);
    }

    public function testUpdateFileFormatSettings(): void
    {
        $this->mockRequest([
            'uri' => 'https://api.crowdin.com/api/v2/projects/8/file-format-settings/10',
            'method' => 'patch',
            'body' => json_encode([
                [
                    'op' => 'replace',
                    'path' => '/settings',
                    'value' => [
                        'exportPattern' => 'android.test.xml',
                    ],
                ],
            ]),
            'response' => json_encode([
                'id' => 10,
                'name' => 'Android XML',
                'format' => 'android',
                'extensions' => [
                    'xml',
                ],
                'settings' => [
                    'exportPattern' => 'android.test.xml',
                ],
                'createdAt' => '2025-03-03T15:36:18+00:00',
                'updatedAt' => '2025-03-03T15:36:18+00:00',
            ]),
        ]);

        $fileFormatSettings = new FileFormatSettings([
            'id' => 10,
            'name' => 'Android XML',
            'format' => 'android',
            'extensions' => [
                'xml',
            ],
            'settings' => [
                'exportPattern' => 'android.xml',
            ],
            'createdAt' => '2025-03-03T15:36:18+00:00',
            'updatedAt' => '2025-03-03T15:36:18+00:00',
        ]);

        $settings = $fileFormatSettings->getSettings();
        $settings['exportPattern'] = 'android.test.xml';

        $fileFormatSettings->setSettings($settings);

        $actual = $this->crowdin->project->updateFileFormatSettings(8, $fileFormatSettings);

        $this->assertInstanceOf(FileFormatSettings::class, $actual);
        $this->assertSame('android.test.xml', $actual->getSettings()['exportPattern']);
    }
}
