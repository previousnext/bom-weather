<?php

declare(strict_types=1);

namespace BomWeather;

use BomWeather\Forecast\DailyForecast;
use BomWeather\Forecast\HourlyForecast;
use BomWeather\Location\Location;
use BomWeather\Observation\Observation;
use BomWeather\Warning\Warning;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * A client for the BOM weather API.
 *
 * The HTTP client passed to this class must be configured with a base URI of
 * "https://api.weather.bom.gov.au/v1/".
 */
class BomClient {

  /**
   * Constructs a new instance.
   */
  public function __construct(
    protected ClientInterface $httpClient,
    protected RequestFactoryInterface $requestFactory,
    protected LoggerInterface $logger,
  ) {}

  /**
   * Searches for locations.
   *
   * @param string $query
   *   The search query, e.g. a place name, postcode, or "lat,lon" pair.
   *
   * @return \BomWeather\Location\Location[]
   *   The matching locations.
   */
  public function searchLocations(string $query): array {
    $data = $this->request('locations?search=' . \rawurlencode($query));
    if ($data === NULL) {
      return [];
    }

    return \array_map(
      static fn (array $location): Location => Location::fromArray($location),
      $data,
    );
  }

  /**
   * Gets a location.
   *
   * @param string $geohash
   *   The geohash.
   *
   * @return \BomWeather\Location\Location|null
   *   The location, or NULL if not found.
   */
  public function getLocation(string $geohash): ?Location {
    $data = $this->request('locations/' . $this->truncateGeohash($geohash));
    return $data === NULL ? NULL : Location::fromArray($data);
  }

  /**
   * Gets the current observation for a location.
   *
   * @param string $geohash
   *   The geohash.
   *
   * @return \BomWeather\Observation\Observation|null
   *   The observation, or NULL if not found.
   */
  public function getObservation(string $geohash): ?Observation {
    $data = $this->request('locations/' . $this->truncateGeohash($geohash) . '/observations');
    return $data === NULL ? NULL : Observation::fromArray($data);
  }

  /**
   * Gets the daily forecasts for a location.
   *
   * @param string $geohash
   *   The geohash.
   *
   * @return \BomWeather\Forecast\DailyForecast[]
   *   The daily forecasts.
   */
  public function getDailyForecasts(string $geohash): array {
    $data = $this->request('locations/' . $this->truncateGeohash($geohash) . '/forecasts/daily');
    if ($data === NULL) {
      return [];
    }

    return \array_map(
      static fn (array $forecast): DailyForecast => DailyForecast::fromArray($forecast),
      $data,
    );
  }

  /**
   * Gets the hourly forecasts for a location.
   *
   * @param string $geohash
   *   The geohash.
   *
   * @return \BomWeather\Forecast\HourlyForecast[]
   *   The hourly forecasts.
   */
  public function getHourlyForecasts(string $geohash): array {
    $data = $this->request('locations/' . $this->truncateGeohash($geohash) . '/forecasts/hourly');
    if ($data === NULL) {
      return [];
    }

    return \array_map(
      static fn (array $forecast): HourlyForecast => HourlyForecast::fromArray($forecast),
      $data,
    );
  }

  /**
   * Gets the current warnings for a location.
   *
   * @param string $geohash
   *   The geohash.
   *
   * @return \BomWeather\Warning\Warning[]
   *   The warnings.
   */
  public function getWarnings(string $geohash): array {
    $data = $this->request('locations/' . $this->truncateGeohash($geohash) . '/warnings');
    if ($data === NULL) {
      return [];
    }

    return \array_map(
      static fn (array $warning): Warning => Warning::fromArray($warning),
      $data,
    );
  }

  /**
   * Gets a single warning, including its full message.
   *
   * @param string $id
   *   The warning ID.
   *
   * @return \BomWeather\Warning\Warning|null
   *   The warning, or NULL if not found.
   */
  public function getWarning(string $id): ?Warning {
    $data = $this->request('warnings/' . $id);
    return $data === NULL ? NULL : Warning::fromArray($data);
  }

  /**
   * Truncates a geohash to the 6 characters required by location endpoints.
   */
  protected function truncateGeohash(string $geohash): string {
    return \substr($geohash, 0, 6);
  }

  /**
   * Performs a GET request and returns the decoded "data" envelope.
   *
   * @param string $path
   *   The path, relative to the API base URI.
   *
   * @return array<mixed>|null
   *   The decoded "data" value, or NULL on failure.
   */
  protected function request(string $path): ?array {
    try {
      $request = $this->requestFactory->createRequest('GET', $path);
      $response = $this->httpClient->sendRequest($request);
    }
    catch (ClientExceptionInterface $e) {
      $this->logger->error("Failed to fetch $path", [
        'exception' => $e,
      ]);
      return NULL;
    }

    if ($response->getStatusCode() >= 300) {
      $this->logger->error("Failed to fetch $path: {$this->describeError($response)}");
      return NULL;
    }

    $body = \json_decode((string) $response->getBody(), TRUE);
    if (!\is_array($body) || !\array_key_exists('data', $body)) {
      $this->logger->error("Failed to fetch $path: unexpected response body");
      return NULL;
    }

    return $body['data'];
  }

  /**
   * Describes an error response, using BOM's error envelope if present.
   */
  protected function describeError(ResponseInterface $response): string {
    $body = \json_decode((string) $response->getBody(), TRUE);
    $detail = $body['errors'][0]['detail'] ?? NULL;
    return $detail ?? (string) $response->getStatusCode();
  }

}
