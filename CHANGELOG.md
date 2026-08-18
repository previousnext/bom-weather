# Changelog

## 2.0.0

Complete rewrite targeting BOM's `https://api.weather.bom.gov.au/v1/` API
(geohash-based, JSON-only) instead of the legacy FTP product feed
(`www.bom.gov.au/fwo/*.xml|json`, product ID/WMO-based). This is a full
breaking change — see [UPGRADE.md](UPGRADE.md).

Highlights:

- New `Location` domain and `BomClient::searchLocations()`/`getLocation()`
  for resolving a place name to a geohash.
- `getObservation()` replaces `getObservationList()`, returning the current
  observation directly.
- `getDailyForecasts()`/`getHourlyForecasts()` replace `getForecast()`.
- `getWarnings()`/`getWarning()` replace `getWarning()`; warnings are now
  flat value objects (the new API has no structured CAP hazard data).
- Dropped the `symfony/serializer` and `ext-xml` dependencies — every
  response is JSON, hydrated with plain PHP.

## 1.0.0-alpha2 and earlier

See git history.
