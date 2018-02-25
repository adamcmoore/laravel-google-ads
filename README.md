<p align="center">
<img src="https://cloud.githubusercontent.com/assets/3541622/17292148/47c841ea-57e8-11e6-80c3-773dfd28a1f4.png" alt="">
</p>

## Google Ads API for Laravel 4.2

A quick fork of [`nikolajlovenhardt/laravel-google-ads`](https://github.com/nikolajlovenhardt/laravel-google-ads) with minor changes to support the aged.

### Setup
- Run `$ composer require adamcmoore/laravel-google-ads`

#### Laravel

- Add provider to config/app.php

```php
'providers' => [
    LaravelGoogleAds\LaravelGoogleAdsProvider::class,
],
```

- Copy the configuration file `config/google-ads.php` and insert:
    - developerToken
    - clientId & clientSecret
    - refreshToken


### Generate refresh token
*This requires that the `clientId` and `clientSecret` is from a native application.*

Run `$ php artisan googleads:token:generate` and open the authorization url. Grant access to the app, and input the
access token in the console. Copy the refresh token into your configuration `config/google-ads.php`

### Basic usage

The following example is for AdWords, but the general code applies to all
products.


```php
<?php

namespace App\Services;

use LaravelGoogleAds\Services\AdWordsService;
use Google\AdsApi\AdWords\AdWordsServices;
use Google\AdsApi\AdWords\AdWordsSessionBuilder;
use Google\AdsApi\AdWords\v201609\cm\CampaignService;
use Google\AdsApi\AdWords\v201609\cm\OrderBy;
use Google\AdsApi\AdWords\v201609\cm\Paging;
use Google\AdsApi\AdWords\v201609\cm\Selector;

class Service
{
    /** @var AdWordsService */
    protected $adWordsService;
    
    /**
     * @param AdWordsService $adWordsService
     */
    public function __construct(AdWordsService $adWordsService)
    {
        $this->adWordsService = $adWordsService;
    }

    public function campaigns()
    {
        $customerClientId = 'xxx-xxx-xx';

        $campaignService = $this->adWordsService->getService(CampaignService::class, $customerClientId);

        // Create selector.
        $selector = new Selector();
        $selector->setFields(array('Id', 'Name'));
        $selector->setOrdering(array(new OrderBy('Name', 'ASCENDING')));

        // Create paging controls.
        $selector->setPaging(new Paging(0, 100));

        // Make the get request.
        $page = $campaignService->get($selector);
    }
}
```

### Best practices
- [AdWords API Workshops Fall 2015](https://www.youtube.com/playlist?list=PLKByxjzUC-N8mEDQF9ARMMkSv0AmYbpsh)
- [Best Practices in Reporting](https://www.youtube.com/watch?v=nRh-sIUqY84&index=2&list=PLKByxjzUC-N8mEDQF9ARMMkSv0AmYbpsh)

### Features, requirements, support etc.
See [`googleads/googleads-php-lib`](https://github.com/googleads/googleads-php-lib/blob/master/README.md)

### Dependencies
- [`googleads/googleads-php-lib`](https://github.com/googleads/googleads-php-lib) hosts the PHP client library for the various SOAP-based Ads APIs (AdWords, AdExchange Buyer, and DFP) at Google.
