<?php

namespace BomWeather\Tests\Functional;

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
    $forecast = $client->getForecast('IDN10031');

    $this->assertNotNull($forecast);
  }

}
