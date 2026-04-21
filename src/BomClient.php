<?php

declare(strict_types=1);

namespace BomWeather;

use BomWeather\Forecast\Forecast;
use BomWeather\Forecast\Serializer\ForecastSerializerFactory;
use BomWeather\Observation\ObservationList;
use BomWeather\Observation\Serializer\ObservationSerializerFactory;
use BomWeather\Warning\Serializer\WarningSerializerFactory;
use BomWeather\Warning\Warning;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * The client.
 */
class BomClient {

  /**
   * Constructs a new instance.
   */
  public function __construct(
    protected ClientInterface $httpClient,
    protected RequestFactoryInterface $requestFactory,
    protected LoggerInterface $logger,
    protected ?SerializerInterface $forecastSerializer = NULL,
    protected ?SerializerInterface $observationSerializer = NULL,
    protected ?SerializerInterface $warningSerializer = NULL,
  ) {
    if ($forecastSerializer == NULL) {
      $forecastSerializer = ForecastSerializerFactory::create();
    }
    $this->forecastSerializer = $forecastSerializer;

    if ($observationSerializer == NULL) {
      $observationSerializer = ObservationSerializerFactory::create();
    }
    $this->observationSerializer = $observationSerializer;

    if ($warningSerializer == NULL) {
      $warningSerializer = WarningSerializerFactory::create();
    }
    $this->warningSerializer = $warningSerializer;
  }

  /**
   * Gets a forecast.
   *
   * @param string $productId
   *   The product ID.
   *
   * @return \BomWeather\Forecast\Forecast|null
   *   The forecast, or NULL if not found.
   */
  public function getForecast(string $productId): ?Forecast {
    try {
      $request = $this->requestFactory->createRequest('GET', "fwo/$productId.xml")
        ->withHeader('Accept-Encoding', 'gzip');
      $response = $this->httpClient->sendRequest($request);

      /** @var \BomWeather\Forecast\Forecast $forecast */
      $forecast = $this->forecastSerializer->deserialize($response->getBody(), Forecast::class, 'xml');
      return $forecast;
    }
    catch (ClientExceptionInterface $e) {
      $this->logger->error("Failed to fetch forecast for ID $productId", [
        'exception' => $e,
      ]);
      return NULL;
    }
  }

  /**
   * Gets an observation.
   *
   * @param string $productId
   *   The product ID. e.g IDN60901.
   * @param string $wmo
   *   The WMO. e.g. 95757.
   *
   * @return \BomWeather\Observation\ObservationList|null
   *   The observation, or null if not found.
   */
  public function getObservationList(string $productId, string $wmo): ?ObservationList {
    try {
      $request = $this->requestFactory->createRequest('GET', "fwo/$productId/$productId.$wmo.json")
        ->withHeader('Accept-Encoding', 'gzip');
      $response = $this->httpClient->sendRequest($request);

      /** @var \BomWeather\Observation\ObservationList $observationList */
      $observationList = $this->observationSerializer->deserialize($response->getBody(), ObservationList::class, 'json');
      return $observationList;
    }
    catch (ClientExceptionInterface $e) {
      $this->logger->error("Failed to fetch observation list for product $productId and WMO $wmo", [
        'exception' => $e,
      ]);
      return NULL;
    }
  }

  /**
   * Gets a warning.
   *
   * @param string $productId
   *   The product ID. e.g IDN20400.
   *
   * @return \BomWeather\Warning\Warning|null
   *   The warning, or NULL if not found.
   */
  public function getWarning(string $productId): ?Warning {
    try {
      $request = $this->requestFactory->createRequest('GET', "fwo/$productId.xml")
        ->withHeader('Accept-Encoding', 'gzip');
      $response = $this->httpClient->sendRequest($request);

      /** @var \BomWeather\Warning\Warning $warning */
      $warning = $this->warningSerializer->deserialize($response->getBody(), Warning::class, 'xml');
      return $warning;
    }
    catch (ClientExceptionInterface $e) {
      $this->logger->error("Failed to fetch warning for ID $productId", [
        'exception' => $e,
      ]);
      return NULL;
    }
  }

}
