<?php

namespace BomWeather\Tests\Functional\Forecast;

use BomWeather\Forecast\ForecastClient;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

/**
 * @coversDefaultClass \BomWeather\Forecast\ForecastClient
 */
class ForecastClientTest extends TestCase {

  /**
   * @covers ::__construct()
   * @covers ::getForecast()
   */
  public function testClient() {

    $logger = new NullLogger();
    $client = new ForecastClient($logger);
    $forecast = $client->getForecast('IDN10064');

    $this->assertNotNull($forecast);
  }

}
