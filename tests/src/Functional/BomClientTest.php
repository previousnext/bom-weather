<?php

declare(strict_types = 1);

namespace BomWeather\Tests\Functional;

use BomWeather\BomClient;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\NullLogger;

/**
 * @coversDefaultClass \BomWeather\BomClient
 */
class BomClientTest extends TestCase {

  /**
   * @covers ::__construct()
   * @covers ::getForecast()
   */
  public function testGetForecast(): void {
    $logger = new NullLogger();
    $httpClient = new Client();
    $response = $this->createMock(ResponseInterface::class);
    $response->method('getBody')->willReturn(\file_get_contents(__DIR__ . '/../../fixtures/IDN10064.xml'));
    $httpClient->addResponse($response);
    $requestFactory = $this->createMock(RequestFactoryInterface::class);
    $client = new BomClient($logger, $httpClient, $requestFactory);
    $forecast = $client->getForecast('IDN10064');

    $this->assertNotNull($forecast);
  }

  /**
   * @covers ::__construct()
   * @covers ::getObservationList()
   */
  public function testGetObservation(): void {
    $logger = new NullLogger();
    $httpClient = new Client();
    $response = $this->createMock(ResponseInterface::class);
    $response->method('getBody')->willReturn(\file_get_contents(__DIR__ . '/../../fixtures/IDN60901.94759.json'));
    $httpClient->addResponse($response);
    $requestFactory = $this->createMock(RequestFactoryInterface::class);
    $client = new BomClient($logger, $httpClient, $requestFactory);
    $observationList = $client->getObservationList('IDN60901', '95757');

    $this->assertNotNull($observationList);

    $refreshMessage = $observationList->getRefreshMessage();

    // Get the latest observation.
    $observation = $observationList->getLatest();
    $rain = $observation->getRainSince9am();

    $station = $observation->getStation();
    $name = $station->getName();

    $temperature = $observation->getTemperature();
    $airTemp = $temperature->getAirTemp();
    $apparentTemp = $temperature->getApparentTemp();
    $relativeHumidity = $temperature->getRelativeHumidity();

    $wind = $observation->getWind();
    $direction = $wind->getDirection();
    $speedKmh = $wind->getSpeedKmh();
    $gustKmh = $wind->getGustKmh();

    $pressure = $observation->getPressure();
    $qnh = $pressure->getQnh();
    $meanSeaLevel = $pressure->getMeanSeaLevel();
  }

}
