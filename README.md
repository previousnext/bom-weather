# BOM Weather

A PHP library for fetching data from the Australian Bureau of Meteorology's
weather API.

## ⚠️ Note on the API

As of v2.0.0, this library talks to `https://api.weather.bom.gov.au/v1/` — the
undocumented internal API that powers the official BOM Weather app and
website. It is **not** a publicly documented or licensed API:

- Every response embeds a copyright notice stating the API "is owned by the
  Bureau of Meteorology" and that you "must not use, copy or share it".
- There is no official rate limit, stability guarantee, or support channel.
  The API can change or start blocking requests without notice.
- If you need a data source with clear terms for commercial or production
  use, see the Bureau's [data services page](https://www.bom.gov.au/resources/data-services)
  instead.

Use of this library is at your own risk and discretion.

## Installation

```
composer require previousnext/bom-weather php-http/discovery
```

The library requires a PSR-18 HTTP client and PSR-17 HTTP factories. We
recommend using [Guzzle](https://docs.guzzlephp.org/en/stable/). Configure
your HTTP client with a base URI of `https://api.weather.bom.gov.au/v1/`.

## Usage

Locations are identified by a "geohash". Search for one by place name,
postcode, or `lat,lon` pair, then use the returned geohash to fetch
observations, forecasts, and warnings.

```php
$httpClient = new GuzzleHttp\Client(['base_uri' => 'https://api.weather.bom.gov.au/v1/']);
$requestFactory = new Http\Factory\Guzzle\RequestFactory();
$client = new BomClient($httpClient, $requestFactory, new NullLogger());

$locations = $client->searchLocations('Melbourne');
$geohash = $locations[0]->getGeohash();
```

### Observations

```php
$observation = $client->getObservation($geohash);

$temp = $observation->getTemp();
$feelsLike = $observation->getTempFeelsLike();
$rain = $observation->getRainSince9am();

$wind = $observation->getWind();
$direction = $wind->getDirection();
$speedKmh = $wind->getSpeedKilometre();

$station = $observation->getStation();
$name = $station->getName();
```

### Daily forecasts

```php
$forecasts = $client->getDailyForecasts($geohash);

foreach ($forecasts as $forecast) {
  $date = $forecast->getDate();
  $maxTemp = $forecast->getTempMax();
  $summary = $forecast->getShortText();
  $chanceOfRain = $forecast->getRain()->getChance();
}
```

### Hourly forecasts

```php
$forecasts = $client->getHourlyForecasts($geohash);

foreach ($forecasts as $forecast) {
  $time = $forecast->getTime();
  $temp = $forecast->getTemp();
  $uv = $forecast->getUv();
}
```

### Warnings

```php
// Warnings currently in effect for a location (summary only).
$warnings = $client->getWarnings($geohash);

foreach ($warnings as $warning) {
  $title = $warning->getTitle();
  $phase = $warning->getPhase();
}

// Fetch the full warning message (raw HTML) by ID.
$warning = $client->getWarning($warnings[0]->getId());
$message = $warning->getMessage();
```

## Upgrading

See [UPGRADE.md](UPGRADE.md) if you're upgrading from a `1.0.0-alpha*`
release.

## Developing

**PHP CodeSniffer**
```
./bin/phpcs
```

**PHPUnit**

```
./bin/phpunit
```

**PHPStan**

```
./bin/phpstan
```
