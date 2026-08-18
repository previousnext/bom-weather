<?php

declare(strict_types=1);

namespace BomWeather\Tests\Functional;

use BomWeather\BomClient;
use GuzzleHttp\Psr7\Stream;
use GuzzleHttp\Psr7\Utils;
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
   * Creates a mock response for a fixture file with the given status code.
   */
  protected function mockResponse(string $fixture, int $statusCode = 200): ResponseInterface {
    $response = $this->createMock(ResponseInterface::class);
    $response->method('getBody')
      ->willReturn(new Stream(Utils::tryFopen(__DIR__ . "/../../fixtures/$fixture", 'r')));
    $response->method('getStatusCode')->willReturn($statusCode);
    return $response;
  }

  /**
   * Creates a client that returns the given response.
   */
  protected function createClient(ResponseInterface $response): BomClient {
    $httpClient = new Client();
    $httpClient->addResponse($response);
    $requestFactory = $this->createMock(RequestFactoryInterface::class);
    $request = $this->createMock(RequestInterface::class);
    $requestFactory->method('createRequest')->willReturn($request);
    return new BomClient($httpClient, $requestFactory, new NullLogger());
  }

  /**
   * Tests the searchLocations method.
   */
  public function testSearchLocations(): void {
    $client = $this->createClient($this->mockResponse('locations-search.json'));
    $locations = $client->searchLocations('Melbourne');

    $this->assertCount(8, $locations);
    $this->assertEquals('r1r0fup', $locations[0]->getGeohash());
    $this->assertEquals('Melbourne', $locations[0]->getName());
    $this->assertEquals('VIC', $locations[0]->getState());
  }

  /**
   * Tests the getLocation method.
   */
  public function testGetLocation(): void {
    $client = $this->createClient($this->mockResponse('location.json'));
    $location = $client->getLocation('r1r0fup');

    $this->assertNotNull($location);
    $this->assertEquals('r1r0fu', $location->getGeohash());
    $this->assertEquals('Australia/Melbourne', $location->getTimezone());
    $this->assertEquals('VIC_MW005', $location->getMarineAreaId());
  }

  /**
   * Tests the getObservation method.
   */
  public function testGetObservation(): void {
    $client = $this->createClient($this->mockResponse('observation.json'));
    $observation = $client->getObservation('r1r0fup');

    $this->assertNotNull($observation);
    $this->assertEquals(13.1, $observation->getTemp());
    $this->assertEquals(0, $observation->getRainSince9am());

    $wind = $observation->getWind();
    $this->assertEquals('N', $wind->getDirection());
    $this->assertEquals(6, $wind->getSpeedKilometre());

    $station = $observation->getStation();
    $this->assertEquals('086338', $station->getBomId());
    $this->assertEquals('Melbourne (Olympic Park)', $station->getName());
  }

  /**
   * Tests the getDailyForecasts method.
   */
  public function testGetDailyForecasts(): void {
    $client = $this->createClient($this->mockResponse('daily-forecasts.json'));
    $forecasts = $client->getDailyForecasts('r1r0fup');

    $this->assertCount(8, $forecasts);
    $this->assertEquals(19, $forecasts[0]->getTempMax());
    $this->assertEquals('moderate', $forecasts[0]->getUv()->getCategory());
    $this->assertEquals(40, $forecasts[0]->getRain()->getChance());
    $this->assertEquals('Max', $forecasts[0]->getNow()->getNowLabel());
  }

  /**
   * Tests the getHourlyForecasts method.
   */
  public function testGetHourlyForecasts(): void {
    $client = $this->createClient($this->mockResponse('hourly-forecasts.json'));
    $forecasts = $client->getHourlyForecasts('r1r0fup');

    $this->assertCount(3, $forecasts);
    $this->assertEquals(15, $forecasts[0]->getTemp());
    $this->assertEquals('NE', $forecasts[0]->getWind()->getDirection());
    $this->assertEquals(2, $forecasts[0]->getUv());
  }

  /**
   * Tests the getWarnings method.
   */
  public function testGetWarnings(): void {
    $client = $this->createClient($this->mockResponse('warnings.json'));
    $warnings = $client->getWarnings('r1r0fup');

    $this->assertCount(1, $warnings);
    $this->assertEquals('VIC_MW005_IDV20600', $warnings[0]->getId());
    $this->assertEquals('marine_wind_warning', $warnings[0]->getType());
    $this->assertNull($warnings[0]->getMessage());
  }

  /**
   * Tests the getWarning method.
   */
  public function testGetWarning(): void {
    $client = $this->createClient($this->mockResponse('warning-detail.json'));
    $warning = $client->getWarning('VIC_MW005_IDV20600');

    $this->assertNotNull($warning);
    $this->assertEquals('Marine Wind Warning for Victoria', $warning->getTitle());
    $this->assertStringContainsString('Strong Wind Warning', $warning->getMessage());
  }

  /**
   * Tests that a non-2xx response is logged and returns NULL.
   */
  public function testRequestErrorReturnsNull(): void {
    $client = $this->createClient($this->mockResponse('error-invalid-geohash.json', 400));
    $observation = $client->getObservation('r1r0fup');

    $this->assertNull($observation);
  }

}
