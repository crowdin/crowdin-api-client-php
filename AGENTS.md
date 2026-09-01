# AGENTS.md

PHP client for the Crowdin API v2 and Crowdin Enterprise API v2.

Supports PHP >= 7.1, so write 7.1-compatible code in `src/`: no typed properties, no constructor promotion, no `match`; document property types with `/** @var */` docblocks. CI tests on 7.4–8.2.

## Layout

- `src/CrowdinApiClient/Crowdin.php` — the client; exposes APIs via `__get()` and naming convention
- `src/CrowdinApiClient/Api/<Name>Api.php` — one class per resource (`extends AbstractApi`); Enterprise-only variants in `Api/Enterprise/`
- `src/CrowdinApiClient/Model/` — models (`extends BaseModel`); Enterprise-only models in `Model/Enterprise/`
- `tests/CrowdinApiClient/` — mirrors `src/` 1:1

## Commands

- Install: `composer install --no-interaction --prefer-dist`
- Test (all): `composer test` (= `vendor/bin/phpunit`)
- Test (one file): `vendor/bin/phpunit tests/CrowdinApiClient/Api/<Name>ApiTest.php`
- Style check (what CI runs): `PHP_CS_FIXER_IGNORE_ENV=true vendor/bin/php-cs-fixer fix --dry-run`
- Style fix: `PHP_CS_FIXER_IGNORE_ENV=true vendor/bin/php-cs-fixer fix`

`PHP_CS_FIXER_IGNORE_ENV=true` is required whenever the local PHP is newer than the pinned fixer supports; CI sets it too.

## Adding or changing an endpoint

Fetch the endpoint spec first (see Crowdin API reference below). Then:

1. Implement the method on `src/CrowdinApiClient/Api/<Name>Api.php` using the `AbstractApi` helpers (`_list`, `_get`, `_create`, `_update`, `_delete`, ...) with a relative path (no leading slash). Method names follow `list`/`get`/`create`/`update`/`delete`.
2. Model: `extends BaseModel`, hydrate every field in the constructor via `$this->getDataProperty('jsonKey')`. The protected property name must exactly match the API JSON key — `update()` sends a JSON-Patch computed by diffing current property values against the original payload, so a mismatched name silently never sends. Nested config objects need a `toArray()` method to serialize in that diff. Optional fields stay uncast so they can remain `null`.
3. For a new resource, register it in `Crowdin.php` in three places: the class-level `@property` docblock, the `$services` array, and the `$servicesEnterprise` array. The service name resolves to a class by convention (`styleGuide` → `StyleGuideApi` via `ucfirst($name) . 'Api'`); when an `Api/Enterprise/<Name>Api` class exists it silently replaces the base class for Enterprise clients.
4. Tests: `tests/.../Api/<Name>ApiTest.php` extends `AbstractTestApi` (the `Api/Enterprise/` one for Enterprise resources), one test per endpoint using `$this->mockRequest*(...)` and asserting path, method, and body; plus `tests/.../Model/<Name>Test.php` covering hydration with and without optional fields. Note `_update()` performs no HTTP request when nothing changed, so an update test must actually modify the model.
5. Document every public method with a PHPDoc block containing two `@link` lines — the developer.crowdin.com operation URL and its enterprise counterpart — and `@param` docs for array keys. CI builds phpDocumentor from these docblocks, so malformed PHPDoc fails the build.

A complete new resource touches ~5 files: the Api class, the Model, `Crowdin.php`, and the two test files. New files start with `declare(strict_types=1);`.

## Crowdin API reference

Before implementing or changing any endpoint, fetch its spec from the llms.txt indexes (pick by environment, then project type):

- https://support.crowdin.com/_llms-txt/api/crowdin/file-based.txt — Crowdin API, file-based projects (start here)
- https://support.crowdin.com/_llms-txt/api/crowdin/string-based.txt — Crowdin API, string-based projects
- https://support.crowdin.com/_llms-txt/api/enterprise/file-based.txt — Crowdin Enterprise API, file-based projects
- https://support.crowdin.com/_llms-txt/api/enterprise/string-based.txt — Crowdin Enterprise API, string-based projects

Each index links one spec file per route (e.g. `.../api.projects.strings.get.txt`) with the exact request and response shapes.

## Conventions

- Conventional Commits for commit messages and PR titles; CI lints PR titles.
- PRs target `master`.
- Keep the public API backward compatible.
- Never edit the `version` field in `composer.json` — the Release workflow bumps it.

## PR checklist

A change is ready when:

1. `composer test` passes,
2. `PHP_CS_FIXER_IGNORE_ENV=true vendor/bin/php-cs-fixer fix --dry-run` reports nothing,
3. every new or changed endpoint method has an Api test asserting the request and a Model test covering hydration, and
4. every new or changed public method carries the two `@link` doc lines.
