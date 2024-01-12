<?php

declare(strict_types = 1);

namespace BomWeather;

use BomWeather\Forecast\Forecast;
use BomWeather\Forecast\Serializer\ForecastSerializerFactory;
use BomWeather\Observation\ObservationList;
use BomWeather\Observation\Serializer\ObservationSerializerFactory;
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
    protected ?SerializerInterface $observationSerializer = NULL
  ) {
    if ($forecastSerializer == NULL) {
      $forecastSerializer = ForecastSerializerFactory::create();
    }
    $this->forecastSerializer = $forecastSerializer;

    if ($observationSerializer == NULL) {
      $observationSerializer = ObservationSerializerFactory::create();
    }
    $this->observationSerializer = $observationSerializer;
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
      $request = $this->requestFactory->createRequest('GET', "http://www.bom.gov.au/fwo/$productId.xml");
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
      $request = $this->requestFactory->createRequest('GET', "http://reg.bom.gov.au/fwo/$productId/$productId.$wmo.json");
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

}
