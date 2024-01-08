<?php

namespace BomWeather\Tests\Functional\Forecast;

use BomWeather\BomClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * @coversDefaultClass \BomWeather\BomClient
 */
class BomClientTest extends TestCase {

  /**
   * @covers ::__construct()
   * @covers ::getForecast()
   */
  public function testGetForecast()
  {
      $productId = 'IDN10064';
      $logger = $this->createMock(LoggerInterface::class);
      $logger
          ->expects($this->never())
          ->method('error');

      $responseBody = file_get_contents(__DIR__ . "/../../tests/fixtures/IDN10064.xml");

      $mock = new MockHandler([
          new Response(
              200,
              [
                  'Accept-Ranges' => 'bytes',
                  'Connection' => 'keep-alive',
                  'Content-Encoding' => 'gzip',
                  'Content-Length' => '2010',
                  'Content-Type' => 'text/xml',
                  'Date' => 'Wed, 20 Jun 2018 21:41:57 +0000',
                  'ETag' => '"42b788-49a7-60e2c007ff680"',
                  'Last-Modified' => 'Wed, 20 Jun 2018 21:41:57 +0000',
                  'Server' => 'Apache',
                  'Server-Timing' => 'cdn-cache; desc=REVALIDATE, edge; dur=46, origin; dur=8, ak_p; desc="1704436748525_388610445_1812004694_5393_6883_16_0_-";dur=1',
                  'Vary' => 'Accept-Encoding',
              ],
              $responseBody
          )
      ]);

      $handlerStack = HandlerStack::create($mock);
      $httpClient = new Client(['handler' => $handlerStack]);
      $client = new BomClient($logger, $httpClient);
      $forecast = $client->getForecast($productId);

      $this->assertNotNull($forecast);
  }

  /**
   * @covers ::__construct()
   * @covers ::getObservationList()
   */
  public function testGetObservation() {

    $logger = new NullLogger();
    $client = new BomClient($logger);
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
    $relativeHumidity = $temperature->getRealtiveHumidity();

    $wind = $observation->getWind();
    $direction = $wind->getDirection();
    $speedKmh = $wind->getSpeedKmh();
    $gustKmh = $wind->getGustKmh();

    $pressure = $observation->getPressure();
    $qnh = $pressure->getQnh();
    $meanSeaLevel = $pressure->getMeanSeaLevel();

  }

}
