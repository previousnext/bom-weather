# BOM Weather

A PHP library for fetching data from the Australian Bureau of Meteorology API.

[![CircleCI](https://circleci.com/gh/previousnext/bom-weather.svg?style=svg)](https://circleci.com/gh/previousnext/bom-weather)


## Installation

```
composer require previousnext/bom-weather
```

## Usage

### Forecasts

```php
$client = new BomClient(new Client(), new RequestFactory(), new NullLogger());
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

### Observations

```php
$client = new BomClient(new Client(), new RequestFactory(), new NullLogger());
$observationList = $client->getObservationList('IDN60901', '95757');

$refreshMessage = $observationList->getRefreshMessage();

// Get the latest observation.
$observation = $observationList->getLatest();
$rain = $observation->getRainSince9am();

// Station information.
$station = $observation->getStation();
$name = $station->getName();

// Temperature observations.
$temperature = $observation->getTemperature();
$airTemp = $temperature->getAirTemp();
$apparentTemp = $temperature->getApparentTemp();
$relativeHumidity = $temperature->getRealtiveHumidity();

// Wind observations.
$wind = $observation->getWind();
$direction = $wind->getDirection();
$speedKmh = $wind->getSpeedKmh();
$gustKmh = $wind->getGustKmh();

// Pressure observations.
$pressure = $observation->getPressure();
$qnh = $pressure->getQnh();
$meanSeaLevel = $pressure->getMeanSeaLevel();
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
