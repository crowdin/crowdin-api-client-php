# Crowdin API client usage examples

- [Create a file in a Crowdin project](#upload-file-to-a-crowdin-project)
- [Update file](#update-file)
- [Build project](#build-project-and-download-translated-files)
- [Create and upload TM](#create-and-upload-tm)
- [Export and download TM](#export-and-download-tm)
- [Create and upload glossary](#create-and-upload-glossary)
- [Export and download glossary](#export-and-download-glossary)
 

---

## Upload file to a Crowdin project

```php
use CrowdinApiClient\Crowdin;

$crowdin = new Crowdin([
    'access_token' => '<access_token>',
    'organization' => '<organization_domain>', // if you use Crowdin Enterprise
]);

$storage = $crowdin->storage->create(new SplFileInfo('<path-to-file>'));
$file = $crowdin->file->create($projectId, ['storageId' => $storage->getId(), 'name' => '<file-name>']);

print_r($file->getData());
```

## Update file

```php
use CrowdinApiClient\Crowdin;

$crowdin = new Crowdin([
    'access_token' => '<access_token>',
    'organization' => '<organization_domain>', // if you use Crowdin Enterprise
]);

$storage = $crowdin->storage->create(new SplFileInfo('<path-to-file-with-updates>'));
$file = $crowdin->file->update($projectId, '<file-id>', ['storageId' => $storage->getId()]);

print_r($file->getData());
```

## Build project and download translated files

```php
use CrowdinApiClient\Crowdin;

$crowdin = new Crowdin([
    'access_token' => '<access_token>',
    'organization' => '<organization_domain>', // if you use Crowdin Enterprise
]);

$projectId = '<project-id>';
$projectBuild = $crowdin->translation->buildProject($projectId);

while ($projectBuild->getStatus() !== 'finished') {
    $projectBuild = $crowdin->translation->getProjectBuildStatus($projectId, $projectBuild->getId());
    sleep(2);
}

$buildArchive = $crowdin->translation->downloadProjectBuild($projectId, $projectBuild->getId());

print_r($buildArchive->getData());
```

## Create and upload TM

```php
use CrowdinApiClient\Crowdin;

$crowdin = new Crowdin([
    'access_token' => '<access_token>',
    'organization' => '<organization_domain>', // if you use Crowdin Enterprise
]);

$tm = $crowdin->translationMemory->create(['name' => 'Test Translation Memory', 'languageId' => 'en']);

$storage = $crowdin->storage->create(new SplFileInfo('<path-to-tmx-file>'));
$tmImport = $crowdin->translationMemory->import($tm->getId(), $storage->getId());

while ($tmImport->getStatus() !== 'finished') {
    $tmImport = $crowdin->translationMemory->checkImportStatus($tm->getId(), $tmImport->getIdentifier());
    sleep(2);
}

$tm = $crowdin->translationMemory->get($tm->getId());

print_r($tm->getData());
```

## Export and download TM

```php
use CrowdinApiClient\Crowdin;

$crowdin = new Crowdin([
    'access_token' => '<access_token>',
    'organization' => '<organization_domain>', // if you use Crowdin Enterprise
]);

$tmId = '<tm-id>';
$tmExport = $crowdin->translationMemory->export($tmId);

while ($tmExport->getStatus() !== 'finished') {
    $tmExport = $crowdin->translationMemory->checkExportStatus($tmId, $tmExport->getIdentifier());
    sleep(2);
}

$tmxFile = $crowdin->translationMemory->download($tmId, $tmExport->getIdentifier());

print_r($tmxFile->getData());
```

## Create and upload glossary

```php
use CrowdinApiClient\Crowdin;

$crowdin = new Crowdin([
    'access_token' => '<access_token>',
    'organization' => '<organization_domain>', // if you use Crowdin Enterprise
]);

$glossary = $crowdin->glossary->create(['name' => 'Test Glossary', 'languageId' => 'en']);

$storage = $crowdin->storage->create(new SplFileInfo('<path-to-tbx-file>'));
$glossaryImport = $crowdin->glossary->import($glossary->getId(), ['storageId' => $storage->getId()]);

while ($glossaryImport->getStatus() !== 'finished') {
    $glossaryImport = $crowdin->glossary->getImport($glossary->getId(), $glossaryImport->getIdentifier());
    sleep(2);
}

$glossary = $crowdin->glossary->get($glossary->getId());

print_r($glossary->getData());
```

## Export and download glossary

```php
use CrowdinApiClient\Crowdin;

$crowdin = new Crowdin([
    'access_token' => '<access_token>',
    'organization' => '<organization_domain>', // if you use Crowdin Enterprise
]);

$glossaryId = '<glossary-id>';
$glossaryExport = $crowdin->glossary->export($glossaryId);

while ($glossaryImport->getStatus() !== 'finished') {
    $glossaryExport = $crowdin->glossary->getExport($glossaryId, $glossaryExport->getIdentifier());
    sleep(2);
}

$tbxFile = $crowdin->glossary->download($glossaryId, $glossaryExport->getIdentifier());

print_r($tbxFile->getData());
```

 
