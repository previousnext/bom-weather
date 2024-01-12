<?php

namespace BomWeather\Tests\Functional\Forecast;

use BomWeather\BomClient;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

/**
 * @coversDefaultClass \BomWeather\BomClient
 */
class BomClientTest extends TestCase {

  /**
   * @covers ::__construct()
   * @covers ::getForecast()
   */
  public function testGetForecast() {

    $logger = new NullLogger();
    $client = new BomClient($logger);
    $forecast = $client->getForecast('IDN10064');

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
