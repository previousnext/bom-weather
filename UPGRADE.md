# Upgrading

## From 1.0.0-alpha* to 2.0.0

Version 2.0.0 is a complete rewrite. It replaces BOM's legacy anonymous-FTP
product feed (`www.bom.gov.au/fwo/*.xml|json`, keyed by product ID and WMO
station number) with BOM's undocumented internal API at
`https://api.weather.bom.gov.au/v1/` (JSON, keyed by geohash). See the
"Note on the API" section in [README.md](README.md) for the terms-of-use
implications of this change.

There is no compatibility layer between the two APIs — every public class and
method has changed.

### `BomClient`

- The constructor no longer takes optional serializer arguments (the
  dependency on `symfony/serializer` has been removed entirely).
- Configure your HTTP client's base URI as
  `https://api.weather.bom.gov.au/v1/` instead of `http://www.bom.gov.au/`.
- All methods now take a **geohash** instead of a product ID/WMO station
  number. Get one via `searchLocations(string $query): Location[]`.
- `getForecast(string $productId): ?Forecast` is replaced by
  `getDailyForecasts(string $geohash): DailyForecast[]` and
  `getHourlyForecasts(string $geohash): HourlyForecast[]`.
- `getObservationList(string $productId, string $wmo): ?ObservationList` is
  replaced by `getObservation(string $geohash): ?Observation`, which returns
  a single current observation rather than a list of historical readings.
- `getWarning(string $productId): ?Warning` is replaced by
  `getWarnings(string $geohash): Warning[]` (summaries for a location) and
  `getWarning(string $id): ?Warning` (full detail, by warning ID).

### Domain classes

- `Observation\Pressure` and `Observation\Temperature` have been removed —
  the new API has no pressure reading, and exposes only `temp`/`tempFeelsLike`
  directly on `Observation` rather than a breakdown of apparent
  temperature/dew point/delta-T.
- `Observation\ObservationList` has been removed — `getObservation()` returns
  a single `Observation` directly.
- `Forecast\Forecast`, `Forecast\ForecastPeriod`, and `Forecast\Area` have
  been replaced by `Forecast\DailyForecast` and `Forecast\HourlyForecast`.
- `Warning\Hazard`, `Warning\HazardCertainty`, `Warning\HazardSeverity`,
  `Warning\HazardUrgency`, and `Warning\WarningInfo` have been removed. The
  new API's warnings are not structured CAP data — `Warning` is now a flat
  value object, and the full warning text is a single HTML `message` string
  rather than structured hazard data.
