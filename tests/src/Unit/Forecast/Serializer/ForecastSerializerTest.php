<?php

declare(strict_types=1);

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
  public function testDeserializeSydney(): void {
    $factory = new ForecastSerializerFactory();
    $serializer = $factory->create();

    $xml = \file_get_contents(__DIR__ . '/../../../../fixtures/IDN10064.xml');

    /** @var \BomWeather\Forecast\Forecast $forecast */
    $forecast = $serializer->deserialize($xml, Forecast::class, 'xml');

    $this->assertNotNull($forecast);
    $this->assertEquals('2018-06-20T21:41:57+00:00', $forecast->getIssueTime()->format(DATE_RFC3339));

    // Regions.
    $regions = $forecast->getRegions();
    $this->assertCount(1, $regions);

    $region = \array_shift($regions);
    $this->assertEquals('NSW_FA001', $region->getAac());
    $this->assertEquals('New South Wales', $region->getDescription());

    $this->assertRegionPeriods($region->getForecastPeriods());

    // Metro areas.
    $metros = $forecast->getMetropolitanAreas();
    $this->assertCount(1, $metros);

    $metro = \array_shift($metros);
    $this->assertEquals('NSW_ME001', $metro->getAac());
    $this->assertEquals('Sydney', $metro->getDescription());
    $this->assertEquals('metropolitan', $metro->getType());
    $this->assertEquals('NSW_FA001', $metro->getParentAac());

    $this->assertMetroPeriods($metro->getForecastPeriods());

    // Locations.
    $locations = $forecast->getLocations();
    $this->assertCount(8, $locations);

    $location = \array_shift($locations);

    $this->assertEquals('NSW_PT131', $location->getAac());
    $this->assertEquals('Sydney', $location->getDescription());
    $this->assertEquals('location', $location->getType());
    $this->assertEquals('NSW_ME001', $location->getParentAac());

    $this->assertSydneyPeriods($location->getForecastPeriods());

    $location = \end($locations);
    $this->assertEquals('NSW_PT237', $location->getAac());
    $this->assertEquals('Bondi', $location->getDescription());

    $this->assertBondiPeriods($location->getForecastPeriods());
  }

  /**
   * Asserts regions are valid.
   *
   * @param \BomWeather\Forecast\ForecastPeriod[] $periods
   *   The regions.
   */
  protected function assertRegionPeriods(array $periods): void {
    $this->assertCount(1, $periods);
    $period = \array_shift($periods);

    $this->assertEquals('2018-06-20T21:41:56+00:00', $period->getStartTime()->format(DATE_RFC3339));
    $this->assertEquals('2018-06-20T21:41:56+00:00', $period->getEndTime()->format(DATE_RFC3339));
    $this->assertNull($period->getForecast());
  }

  /**
   * Asserts metro periods are valid.
   *
   * @param \BomWeather\Forecast\ForecastPeriod[] $metroPeriods
   *   The periods.
   */
  protected function assertMetroPeriods(array $metroPeriods): void {
    $this->assertCount(7, $metroPeriods);
    $period = \array_shift($metroPeriods);

    $this->assertEquals('2018-06-20T14:00:00+00:00', $period->getStartTime()->format(DATE_RFC3339));
    $this->assertEquals('2018-06-21T14:00:00+00:00', $period->getEndTime()->format(DATE_RFC3339));
    $this->assertEquals('Cloudy. High (70%) chance of showers along the coastal fringe, slight (30%) chance elsewhere, becoming less likely in the late afternoon and evening. Light winds.', $period->getForecast());
    $this->assertEquals('Sun protection not recommended, UV Index predicted to reach 2 [Low]', $period->getUvAlert());

    $period = \array_shift($metroPeriods);

    $this->assertEquals('2018-06-21T14:00:00+00:00', $period->getStartTime()->format(DATE_RFC3339));
    $this->assertEquals('2018-06-22T14:00:00+00:00', $period->getEndTime()->format(DATE_RFC3339));
    $this->assertEquals('Mostly sunny. Fog and patches of light frost in the west in the early morning. Light winds.', $period->getForecast());
    $this->assertNull($period->getUvAlert());
  }

  /**
   * Asserts location periods are valid.
   *
   * @param \BomWeather\Forecast\ForecastPeriod[] $locationPeriods
   *   The location periods.
   */
  protected function assertSydneyPeriods(array $locationPeriods): void {
    $this->assertCount(7, $locationPeriods);
    $period = \array_shift($locationPeriods);

    $this->assertEquals('2018-06-20T21:37:12+00:00', $period->getStartTime()->format(DATE_RFC3339));
    $this->assertEquals('2018-06-21T14:00:00+00:00', $period->getEndTime()->format(DATE_RFC3339));

    $this->assertEquals('Showers.', $period->getPrecis());
    $this->assertEquals('80%', $period->getProbabilityOfPrecipitation());
    $this->assertEquals(11, $period->getIconCode());
    $this->assertNull($period->getAirTempMinimum());
    $this->assertEquals(16, $period->getAirTempMaximum());
    $this->assertNull($period->getPrecipitationRange());

    $period = \array_shift($locationPeriods);

    $this->assertEquals('2018-06-21T14:00:00+00:00', $period->getStartTime()->format(DATE_RFC3339));
    $this->assertEquals('2018-06-22T14:00:00+00:00', $period->getEndTime()->format(DATE_RFC3339));

    $this->assertEquals('Mostly sunny.', $period->getPrecis());
    $this->assertEquals('10%', $period->getProbabilityOfPrecipitation());
    $this->assertEquals(3, $period->getIconCode());
    $this->assertEquals(9, $period->getAirTempMinimum());
    $this->assertEquals(18, $period->getAirTempMaximum());
    $this->assertNull($period->getPrecipitationRange());
  }

  /**
   * Asserts location periods are valid.
   *
   * @param \BomWeather\Forecast\ForecastPeriod[] $locationPeriods
   *   The location periods.
   */
  protected function assertBondiPeriods(array $locationPeriods): void {
    $this->assertCount(1, $locationPeriods);

    $period = \array_shift($locationPeriods);
    $this->assertEquals('2018-06-20T21:37:12+00:00', $period->getStartTime()->format(DATE_RFC3339));
    $this->assertEquals('2018-06-21T14:00:00+00:00', $period->getEndTime()->format(DATE_RFC3339));
    $this->assertEquals(16, $period->getAirTempMaximum());

    $this->assertNull($period->getAirTempMinimum());
    $this->assertNull($period->getIconCode());
    $this->assertNull($period->getPrecis());
    $this->assertNull($period->getPrecipitationRange());
    $this->assertNull($period->getProbabilityOfPrecipitation());
  }

}
