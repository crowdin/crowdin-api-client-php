<?php

namespace CrowdinApiClient\Tests\Model;

use CrowdinApiClient\Model\Project;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    public $data = [
        'id' => 8,
        'groupId' => 4,
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
                'pluralCategoryNames' => ['one'],
                'pluralRules' => '(n != 1)',
                'pluralExamples' => ['0, 2-999; 1.2, 2.07...'],
                'textDirection' => 'ltr',
                'dialectOf' => 'string',
            ],
        ],
        'languageAccessPolicy' => 'moderate',
        'name' => 'Knowledge Base',
        'cname' => 'my-custom-domain.crowdin.com',
        'identifier' => '1f198a4e907688bc65834a6d5a6000c3',
        'description' => 'Vault of all terms and their explanation',
        'logo' => 'data:image/png;base64,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',
        'background' => 'data:image/png;base64,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',
        'isExternal' => false,
        'externalType' => 'proofread',
        'workflowId' => 3,
        'hasCrowdsourcing' => false,
        'hiddenStringsProofreadersAccess' => false,
        'createdAt' => '2019-09-20T11:34:40+00:00',
        'updatedAt' => '2019-09-20T11:34:40+00:00',
        'lastActivity' => '2019-09-20T11:34:40+00:00',
        'translateDuplicates' => 1,
        'isMtAllowed' => true,
        'autoSubstitution' => true,
        'skipUntranslatedStrings' => false,
        'skipUntranslatedFiles' => false,
        'exportWithMinApprovalsCount' => 0,
        'exportApprovedOnly' => false,
        'autoTranslateDialects' => true,
        'publicDownloads' => true,
        'useGlobalTm' => false,
        'inContext' => true,
        'inContextProcessHiddenStrings' => true,
        'inContextPseudoLanguageId' => 'uk',
        'isSuspended' => false,
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
        'customQaCheckIds' => ['1'],
        'languageMapping' => [
            'uk' => [
                'name' => 'Ukrainian',
                'two_letters_code' => 'ua',
                'three_letters_code' => 'ukr',
                'locale' => 'uk-UA',
                'locale_with_underscore' => 'uk_UA',
                'android_code' => 'uk-rUA',
                'osx_code' => 'ua.lproj',
                'osx_locale' => 'ua',
            ],
            'es' => [
                'name' => 'Spanish',
                'two_letters_code' => 'es',
                'three_letters_code' => 'es',
                'locale' => 'es-ES',
                'locale_with_underscore' => 'es_ES',
                'android_code' => 'es-rES',
                'osx_code' => 'es.lproj',
                'osx_locale' => 'es',
            ],
        ],

        'glossaryAccess' => true,
        'normalizePlaceholder' => false,
        'saveMetaInfoInSource' => false,
        'notificationSettings' => [
            'translatorNewStrings' => true,
            'managerNewStrings' => false,
            'managerLanguageCompleted' => true,
        ],
        'joinPolicy' => null,
        'visibility' => null,
        'defaultTmId' => 10,
        'defaultGlossaryId' => 20,
        'fields' => [
            'client-company-task' => 'ACME Corp',
        ],
    ];

    public function testLoadData(): void
    {
        $project = new Project($this->data);
        $this->assertEquals($this->data['id'], $project->getId());
        $this->assertEquals($this->data['groupId'], $project->getGroupId());
        $this->assertEquals($this->data['userId'], $project->getUserId());
        $this->assertEquals($this->data['sourceLanguageId'], $project->getSourceLanguageId());
        $this->assertEquals($this->data['targetLanguageIds'], $project->getTargetLanguageIds());
        $this->assertEquals($this->data['targetLanguages'], $project->getTargetLanguages());
        $this->assertEquals($this->data['languageAccessPolicy'], $project->getLanguageAccessPolicy());
        $this->assertEquals($this->data['name'], $project->getName());
        $this->assertEquals($this->data['cname'], $project->getCname());
        $this->assertEquals($this->data['identifier'], $project->getIdentifier());
        $this->assertEquals($this->data['description'], $project->getDescription());
        $this->assertEquals($this->data['visibility'], $project->getVisibility());
        $this->assertEquals($this->data['logo'], $project->getLogo());
        $this->assertEquals($this->data['background'], $project->getBackground());
        $this->assertEquals($this->data['isExternal'], $project->isExternal());
        $this->assertEquals($this->data['externalType'], $project->getExternalType());
        $this->assertEquals($this->data['workflowId'], $project->getWorkflowId());
        $this->assertEquals($this->data['hasCrowdsourcing'], $project->isHasCrowdsourcing());
        $this->assertEquals(
            $this->data['hiddenStringsProofreadersAccess'],
            $project->isHiddenStringsProofreadersAccess()
        );
        $this->assertEquals($this->data['createdAt'], $project->getCreatedAt());
        $this->assertEquals($this->data['updatedAt'], $project->getUpdatedAt());
        $this->assertEquals($this->data['lastActivity'], $project->getLastActivity());

        $this->assertEquals($this->data['translateDuplicates'], $project->getTranslateDuplicates());
        $this->assertEquals($this->data['isMtAllowed'], $project->isMtAllowed());
        $this->assertEquals($this->data['autoSubstitution'], $project->isAutoSubstitution());
        $this->assertEquals($this->data['skipUntranslatedStrings'], $project->isSkipUntranslatedStrings());
        $this->assertEquals($this->data['skipUntranslatedFiles'], $project->isSkipUntranslatedFiles());
        $this->assertEquals(
            $this->data['exportWithMinApprovalsCount'],
            $project->getExportWithMinApprovalsCount()
        );
        $this->assertEquals($this->data['exportApprovedOnly'], $project->isExportApprovedOnly());
        $this->assertEquals($this->data['autoTranslateDialects'], $project->isAutoTranslateDialects());
        $this->assertEquals($this->data['publicDownloads'], $project->isPublicDownloads());
        $this->assertEquals($this->data['useGlobalTm'], $project->isUseGlobalTm());
        $this->assertEquals($this->data['inContext'], $project->isInContext());
        $this->assertEquals(
            $this->data['inContextProcessHiddenStrings'],
            $project->isInContextProcessHiddenStrings()
        );
        $this->assertEquals($this->data['inContextPseudoLanguageId'], $project->getInContextPseudoLanguageId());
        $this->assertEquals($this->data['qaCheckIsActive'], $project->isQaCheckIsActive());
        $this->assertEquals($this->data['qaCheckCategories'], $project->getQaCheckCategories());
        $this->assertEquals(
            $this->data['qaChecksIgnorableCategories'],
            $project->getQaChecksIgnorableCategories()
        );
        $this->assertEquals($this->data['customQaCheckIds'], $project->getCustomQaCheckIds());
        $this->assertEquals($this->data['languageMapping'], $project->getLanguageMapping());
        $this->assertEquals($this->data['isSuspended'], $project->isSuspended());

        $this->assertEquals($this->data['glossaryAccess'], $project->isGlossaryAccess());
        $this->assertEquals($this->data['normalizePlaceholder'], $project->isNormalizePlaceholder());
        $this->assertEquals($this->data['saveMetaInfoInSource'], $project->isSaveMetaInfoInSource());
        $this->assertEquals($this->data['notificationSettings'], $project->getNotificationSettings());
        $this->assertEquals($this->data['defaultTmId'], $project->getDefaultTmId());
        $this->assertEquals($this->data['defaultGlossaryId'], $project->getDefaultGlossaryId());
        $this->assertEquals($this->data['fields'], $project->getFields());
    }

    public function testSetData(): void
    {
        $targetLanguageIds = ['uk'];
        $languageAccessPolicy = 'moderate';
        $fields = ['test' => 'test'];

        $project = new Project();
        $project->setName($this->data['name']);
        $project->setCname($this->data['cname']);
        $project->setTargetLanguageIds($targetLanguageIds);
        $project->setLanguageAccessPolicy($languageAccessPolicy);
        $project->setDescription($this->data['description']);
        $project->setDefaultTmId($this->data['defaultTmId']);
        $project->setDefaultGlossaryId($this->data['defaultGlossaryId']);
        $project->setFields($fields);

        $this->assertEquals($this->data['name'], $project->getName());
        $this->assertEquals($this->data['cname'], $project->getCname());
        $this->assertEquals($this->data['description'], $project->getDescription());
        $this->assertEquals($targetLanguageIds, $project->getTargetLanguageIds());
        $this->assertEquals($languageAccessPolicy, $project->getLanguageAccessPolicy());
        $this->assertEquals($this->data['defaultTmId'], $project->getDefaultTmId());
        $this->assertEquals($this->data['defaultGlossaryId'], $project->getDefaultGlossaryId());
        $this->assertEquals($fields, $project->getFields());
    }
}
