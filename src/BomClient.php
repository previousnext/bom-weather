<?php

namespace BomWeather;

use BomWeather\Forecast\Forecast;
use BomWeather\Forecast\Serializer\ForecastSerializerFactory;
use BomWeather\Observation\ObservationList;
use BomWeather\Observation\Serializer\ObservationSerializerFactory;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * The client.
 */
class BomClient {

  /**
   * The Guzzle client.
   *
   * @var \GuzzleHttp\Client
   */
  protected $httpClient;

  /**
   * The serializer.
   *
   * @var \Symfony\Component\Serializer\SerializerInterface
   */
  protected $forecastSerializer;

  /**
   * The logger.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * The observation serializer.
   *
   * @var \Symfony\Component\Serializer\SerializerInterface
   */
  private $observationSerializer;

  /**
   * ForecastClient constructor.
   *
   * @param \Psr\Log\LoggerInterface $logger
   *   The logger.
   * @param \GuzzleHttp\ClientInterface $httpClient
   *   The HTTP client.
   * @param \Symfony\Component\Serializer\SerializerInterface $forecastSerializer
   *   The serializer.
   * @param \Symfony\Component\Serializer\SerializerInterface $observationSerializer
   *   The observation serializer.
   */
  public function __construct(
    LoggerInterface $logger,
    ClientInterface $httpClient = NULL,
    SerializerInterface $forecastSerializer = NULL,
    SerializerInterface $observationSerializer = NULL
  ) {
    $this->logger = $logger;
    if ($httpClient == NULL) {
      $httpClient = new Client([
        'headers' => ['Accept-Encoding' => 'gzip'],
      ]);
    }
    $this->httpClient = $httpClient;

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
   *
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function getForecast(string $productId): ?Forecast {
    try {
      $response = $this->httpClient->request('GET', "http://www.bom.gov.au/fwo/$productId.xml");

      /** @var \BomWeather\Forecast\Forecast $forecast */
      $forecast = $this->forecastSerializer->deserialize($response->getBody(), Forecast::class, 'xml');
      return $forecast;
    }
    catch (ClientException $e) {
      $this->logger->error("Failed to fetch forecast for ID $productId");
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
   *
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function getObservationList(string $productId, string $wmo): ?ObservationList {
    try {
      $response = $this->httpClient->request('GET', "http://reg.bom.gov.au/fwo/$productId/$productId.$wmo.json");
      $observationList = $this->observationSerializer->deserialize($response->getBody(), ObservationList::class, 'json');
      return $observationList;
    }
    catch (ClientException $e) {
      $this->logger->error("Failed to fetch observation list for product $productId and WMO $wmo");
      return NULL;
    }
  }

}
