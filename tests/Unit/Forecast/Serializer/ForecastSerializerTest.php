<?php

namespace BomWeather\Tests\Unit\Forecast\Serializer;

use BomWeather\Forecast\Forecast;
use BomWeather\Forecast\Serializer\ForecastSerializerFactory;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \BomWeather\Forecast\Serializer\ForecastSerializerFactory
 */
class ForecastSerializerTest extends TestCase {

  /**
   * @covers ::create
   */
  public function testSerialize() {
    $factory = new ForecastSerializerFactory();
    $serializer = $factory->create();

    $xml = file_get_contents(__DIR__ . '/../../../fixtures/IDN10064.xml');

    $forecast = $serializer->deserialize($xml, Forecast::class, 'xml');

    $this->assertNotNull($forecast);
  }

}
