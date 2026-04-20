<?php

declare(strict_types=1);

namespace BomWeather\Tests\Functional;

use BomWeather\BomClient;
use GuzzleHttp\Psr7\Stream;
use Http\Mock\Client;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\NullLogger;

/**
 * Tests the BOM client.
 */
#[CoversClass(BomClient::class)]
class BomClientTest extends TestCase {

  /**
   * Tests the getForecast method.
   */
  public function testGetForecast(): void {
    $logger = new NullLogger();
    $httpClient = new Client();
    $response = $this->createMock(ResponseInterface::class);
    $response->method('getBody')
      ->willReturn(new Stream(\fopen(__DIR__ . '/../../fixtures/IDN10064.xml', 'r')));
    $httpClient->addResponse($response);
    $requestFactory = $this->createMock(RequestFactoryInterface::class);
    $request = $this->createMock(RequestInterface::class);
    $requestFactory->method('createRequest')
      ->willReturn($request);
    $request->method('withHeader')->willReturn($request);
    $client = new BomClient($httpClient, $requestFactory, $logger);
    $forecast = $client->getForecast('IDN10064');

    $this->assertNotNull($forecast);
  }

  /**
   * Tests the getObservationList method.
   */
  public function testGetObservation(): void {
    $logger = new NullLogger();
    $httpClient = new Client();
    $response = $this->createMock(ResponseInterface::class);
    $response->method('getBody')
      ->willReturn(new Stream(\fopen(__DIR__ . '/../../fixtures/IDN60901.94759.json', 'r')));
    $httpClient->addResponse($response);
    $requestFactory = $this->createMock(RequestFactoryInterface::class);
    $request = $this->createMock(RequestInterface::class);
    $requestFactory->method('createRequest')
      ->willReturn($request);
    $request->method('withHeader')->willReturn($request);
    $client = new BomClient($httpClient, $requestFactory, $logger);
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
