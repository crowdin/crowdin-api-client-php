[<p align="center"><img src="https://support.crowdin.com/assets/logos/crowdin-dark-symbol.png" data-canonical-src="https://support.crowdin.com/assets/logos/crowdin-dark-symbol.png" width="200" height="200" align="center"/></p>](https://crowdin.com)

# Crowdin PHP client

The Crowdin PHP client is a lightweight interface to the Crowdin API v2. It provides common services for making API requests.

Our API is a full-featured RESTful API that helps you to integrate localization into your development process. The endpoints that we use allow you to easily make calls to retrieve information and to execute actions needed.

<div align="center">

[**`API Client Docs`**](https://crowdin.github.io/crowdin-api-client-php/packages/Crowdin.html) &nbsp;|&nbsp;
[**`Crowdin API`**](https://developer.crowdin.com/api/v2/) &nbsp;|&nbsp;
[**`Crowdin Enterprise API`**](https://developer.crowdin.com/enterprise/api/v2/)

[![Packagist Version](https://img.shields.io/packagist/v/crowdin/crowdin-api-client?cacheSeconds=3600)](https://packagist.org/packages/crowdin/crowdin-api-client)
[![Packagist](https://img.shields.io/packagist/dt/crowdin/crowdin-api-client?cacheSeconds=3600)](https://packagist.org/packages/crowdin/crowdin-api-client)
[![GitHub Release Date](https://img.shields.io/github/release-date/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/releases)
[![GitHub issues](https://img.shields.io/github/issues/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/issues)
[![GitHub contributors](https://img.shields.io/github/contributors/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/graphs/contributors)
[![GitHub](https://img.shields.io/github/license/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/blob/master/LICENSE)

[![Azure DevOps builds (branch)](https://img.shields.io/azure-devops/build/crowdin/crowdin-api-client-php/15/master?logo=azure-pipelines&cacheSeconds=800)](https://dev.azure.com/crowdin/crowdin-api-client-php/_build/latest?definitionId=15&branchName=master)
[![Azure DevOps tests (branch)](https://img.shields.io/azure-devops/tests/crowdin/crowdin-api-client-php/16/master?cacheSeconds=800)](https://dev.azure.com/crowdin/crowdin-api-client-php/_build/latest?definitionId=15&branchName=master)
[![codecov](https://codecov.io/gh/crowdin/crowdin-api-client-php/branch/master/graph/badge.svg)](https://codecov.io/gh/crowdin/crowdin-api-client-php)

</div>

## Table of Contents
* [Requirements](#requirements)
* [Installation](#installation)
* [Quick Start](#quick-start)
* [Seeking Assistance](#seeking-assistance)
* [Contributing](#contributing)
* [License](#license)

### Requirements

* PHP >= 7.1

## Installation

Install via Composer

    composer require crowdin/crowdin-api-client

### Quick Start

The API client must be instantiated and configured before calling any API method.

```php
use CrowdinApiClient\Crowdin;

$crowdin = new Crowdin([
    'access_token' => '<access_token>',
    'organization' => '<organization_domain>', // optional
]);
```

`<access_token>` - Personal Access Token. You can generate Personal Access Token in your Crowdin Account Settings.

`<organization_domain>` - Organization domain name (for Crowdin Enterprise users only).

For more about Authorization see the [documentation](https://developer.crowdin.com/api/v2/#section/Introduction/Authorization).

#### Running methods

* Create
    ```php
    $directory = $crowdin->directory->create(
        <project_id>,
        ['name'=> 'My Directory']
    );
    ```

* Edit
    ```php
    $directory->setTitle('My Title');

    $crowdin->directory->update($directory);
    ```

* Delete
    ```php
    $crowdin->directory->delete($directory->getProjectId(), $directory->getId());
    ```

## Seeking Assistance

If you find any problems or would like to suggest a feature, please read the [How can I contribute](/CONTRIBUTING.md#how-can-i-contribute) section in our contributing guidelines.

Need help working with Crowdin PHP client or have any questions? [Contact](https://crowdin.com/contacts) Customer Success Service.

## Contributing

If you want to contribute please read the [Contributing](/CONTRIBUTING.md) guidelines.

### License
<pre>
The Crowdin PHP client is licensed under the MIT License.
See the LICENSE file distributed with this work for additional
information regarding copyright ownership.

Except as contained in the LICENSE file, the name(s) of the above copyright
holders shall not be used in advertising or otherwise to promote the sale,
use or other dealings in this Software without prior written authorization.
</pre>
