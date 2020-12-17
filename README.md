[<p align="center"><img src="https://support.crowdin.com/assets/logos/crowdin-dark-symbol.png" data-canonical-src="https://support.crowdin.com/assets/logos/crowdin-dark-symbol.png" width="200" height="200" align="center"/></p>](https://crowdin.com)

# Crowdin PHP client

The Crowdin PHP client is a lightweight interface to the Crowdin API v2. It provides common services for making API requests.

Our API is a full-featured RESTful API that helps you to integrate localization into your development process. The endpoints that we use allow you to easily make calls to retrieve information and to execute actions needed.

For more about Crowdin API v2 see the documentation:
- [Crowdin](https://support.crowdin.com/api/v2/)
- [Crowdin Enterprise](https://support.crowdin.com/enterprise/api/)

## Status

[![Packagist Version](https://img.shields.io/packagist/v/crowdin/crowdin-api-client?cacheSeconds=3600)](https://packagist.org/packages/crowdin/crowdin-api-client)
[![Packagist](https://img.shields.io/packagist/dt/crowdin/crowdin-api-client?cacheSeconds=3600)](https://packagist.org/packages/crowdin/crowdin-api-client)
[![GitHub Release Date](https://img.shields.io/github/release-date/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/releases)
[![GitHub issues](https://img.shields.io/github/issues/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/issues)
[![GitHub contributors](https://img.shields.io/github/contributors/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/graphs/contributors)
[![GitHub](https://img.shields.io/github/license/crowdin/crowdin-api-client-php?cacheSeconds=3600)](https://github.com/crowdin/crowdin-api-client-php/blob/master/LICENSE)


[![Azure DevOps builds (branch)](https://img.shields.io/azure-devops/build/crowdin/crowdin-api-client-php/15/master?logo=azure-pipelines&cacheSeconds=800)](https://dev.azure.com/crowdin/crowdin-api-client-php/_build/latest?definitionId=15&branchName=master)
[![Azure DevOps tests (branch)](https://img.shields.io/azure-devops/tests/crowdin/crowdin-api-client-php/16/master?cacheSeconds=800)](https://dev.azure.com/crowdin/crowdin-api-client-php/_build/latest?definitionId=15&branchName=master)
[![codecov](https://codecov.io/gh/crowdin/crowdin-api-client-php/branch/master/graph/badge.svg)](https://codecov.io/gh/crowdin/crowdin-api-client-php)

## Table of Contents
* [Requirements](#requirements)
* [Installation](#installation)
* [Quick Start](#quick-start)
* [Contribution](#contribution)
* [Seeking Assistance](#seeking-assistance)
* [License](#license)

### Requirements

* PHP >= 7.1

## Installation

1. Install via Composer

    `composer require crowdin/crowdin-api-client`

2. Download this library to your project's 3rd party libraries path

    ```
    git clone https://github.com/crowdin/crowdin-api-client-php.git </your-project/libs/crowdin>
    ```

    and include the library in your project:

    ```php
    require_once 'path/to/Crowdin.php';
    ```

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

For more about Authorization see the [documentation](https://support.crowdin.com/api/v2/#section/Introduction/Authorization).

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

### Contribution
We are happy to accept contributions to the Crowdin PHP client. To contribute please do the following:
1. Fork the repository on GitHub.
2. Decide which code you want to submit. Commit your changes and push to the new branch.
3. Ensure that your code adheres to standard conventions, as used in the rest of the library.
4. Ensure that there are unit tests for your code.
5. Submit a pull request with your patch on Github.

### Seeking Assistance
If you find any problems or would like to suggest a feature, please feel free to file an issue on Github at [Issues Page](https://github.com/crowdin/crowdin-api-client-php/issues).

Need help working with Crowdin PHP client or have any questions?
[Contact Customer Success Service](https://crowdin.com/contacts).

### License
<pre>
Copyright © 2020 Crowdin

The Crowdin PHP client is licensed under the MIT License.
See the LICENSE file distributed with this work for additional
information regarding copyright ownership.

Except as contained in the LICENSE file, the name(s) of the above copyright
holders shall not be used in advertising or otherwise to promote the sale,
use or other dealings in this Software without prior written authorization.
</pre>
