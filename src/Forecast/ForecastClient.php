<?php

namespace BomWeather\Forecast;

use BomWeather\Forecast\Serializer\ForecastSerializerFactory;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * The client.
 */
class ForecastClient {

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
  protected $serializer;

  /**
   * The logger.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * ForecastClient constructor.
   *
   * @param \Psr\Log\LoggerInterface $logger
   *   The logger.
   * @param \GuzzleHttp\ClientInterface $httpClient
   *   The HTTP client.
   * @param \Symfony\Component\Serializer\SerializerInterface $serializer
   *   The serializer.
   */
  public function __construct(LoggerInterface $logger, ClientInterface $httpClient = NULL, SerializerInterface $serializer = NULL) {
    $this->logger = $logger;
    if ($httpClient == NULL) {
      $httpClient = new Client([
        'headers' => ['Accept-Encoding' => 'gzip'],
      ]);
    }
    $this->httpClient = $httpClient;
    if ($serializer == NULL) {
      $serializer = ForecastSerializerFactory::create();
    }
    $this->serializer = $serializer;
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
      $forecast = $this->serializer->deserialize($response->getBody(), Forecast::class, 'xml');
      return $forecast;
    }
    catch (ClientException $e) {
      $this->logger->error("Failed to fetch forecast for ID $productId");
      return NULL;
    }

  }

}
