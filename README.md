# BOM Weather

A PHP library for fetching data from the Australian Bureau of Meteorology API.

[![CircleCI](https://circleci.com/gh/kimpepper/bom-weather.svg?style=svg)](https://circleci.com/gh/kimpepper/bom-weather)


## Installation

```
composer require kimpepper/bom-weather
```

## Usage

```php
$logger = new NullLogger();
$client = new ForecastClient($logger);
$forecast = $client->getForecast('IDN10031');

$issueTime = $forecast->getIssueTime();

$regions = $forecast->getRegions();
$metros = $forecast->getMetropolitanAreas();
$locations = $forecast->getLocations();

foreach ($locations as $location) {
  $aac = $location->getAac();
  $desc = $location->getDescription();

  /** @var \BomWeather\Forecast\ForecastPeriod[] $periods */
  $periods = $location->getForecastPeriods();

  // Usually 7 days of forecast data.
  foreach ($periods as $period) {
    $date = $period->getStartTime();
    $maxTemp = $period->getAirTempMaximum();
    $precis = $period->getPrecis();
  }
}

```

## Developing

PHP CodeSniffer
```
./bin/phpcs
```

PHPUnit

```
./bin/phpunit
```
