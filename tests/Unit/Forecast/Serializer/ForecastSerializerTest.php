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
  public function testDeserializeSydney() {
    $factory = new ForecastSerializerFactory();
    $serializer = $factory->create();

    $xml = file_get_contents(__DIR__ . '/../../../fixtures/IDN10064.xml');

    /** @var \BomWeather\Forecast\Forecast $forecast */
    $forecast = $serializer->deserialize($xml, Forecast::class, 'xml');

    $this->assertNotNull($forecast);
    $this->assertEquals('2018-06-20T21:41:57+0000', $forecast->getIssueTime()->format(\DateTimeInterface::ISO8601));

    // Regions.
    $regions = $forecast->getRegions();
    $this->assertCount(1, $regions);

    $region = array_shift($regions);
    $this->assertEquals('NSW_FA001', $region->getAac());
    $this->assertEquals('New South Wales', $region->getDescription());

    $this->assertRegionPeriods($region->getForecastPeriods());

    // Metro areas.
    $metros = $forecast->getMetropolitanAreas();
    $this->assertCount(1, $metros);

    $metro = array_shift($metros);
    $this->assertEquals('NSW_ME001', $metro->getAac());
    $this->assertEquals('Sydney', $metro->getDescription());

    $this->assertMetroPeriods($metro->getForecastPeriods());

    // Locations.
    $locations = $forecast->getLocations();
    $this->assertCount(8, $locations);

    $location = array_shift($locations);

    $this->assertEquals('NSW_PT131', $location->getAac());
    $this->assertEquals('Sydney', $location->getDescription());

  }

  /**
   * Asserts regions are valid.
   *
   * @param \BomWeather\Forecast\RegionForecastPeriod[] $periods
   *   The regions.
   */
  protected function assertRegionPeriods(array $periods) {
    $this->assertCount(1, $periods);
    $period = array_shift($periods);

    $this->assertEquals('2018-06-20T21:41:56+0000', $period->getStartTime()->format(\DateTimeInterface::ISO8601));
    $this->assertEquals('2018-06-20T21:41:56+0000', $period->getEndTime()->format(\DateTimeInterface::ISO8601));
    $this->assertNull($period->getForecast());
  }

  /**
   * Asserts metro periods are valid.
   *
   * @param \BomWeather\Forecast\MetropolitanForecastPeriod[] $metroPeriods
   *   The periods.
   */
  protected function assertMetroPeriods(array $metroPeriods) {
    $this->assertCount(7, $metroPeriods);
    $period = array_shift($metroPeriods);

    $this->assertEquals('2018-06-20T14:00:00+0000', $period->getStartTime()->format(\DateTimeInterface::ISO8601));
    $this->assertEquals('2018-06-21T14:00:00+0000', $period->getEndTime()->format(\DateTimeInterface::ISO8601));
    $this->assertEquals('Cloudy. High (70%) chance of showers along the coastal fringe, slight (30%) chance elsewhere, becoming less likely in the late afternoon and evening. Light winds.', $period->getForecast());
  }

}
