<?php

declare(strict_types=1);

namespace BomWeather\Tests\Unit\Forecast;

use BomWeather\Forecast\HourlyForecast;
use BomWeather\Forecast\HourlyRain;
use BomWeather\Forecast\Wind;
use BomWeather\Tests\FixtureTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Tests the HourlyForecast value object.
 */
#[CoversClass(HourlyForecast::class)]
#[CoversClass(HourlyRain::class)]
#[CoversClass(Wind::class)]
class HourlyForecastTest extends TestCase {

  use FixtureTrait;

  /**
   * Tests hydration from an array of data.
   */
  public function testFromArray(): void {
    $json = $this->readFixture('hourly-forecasts.json');
    $data = \json_decode($json, TRUE);

    $forecasts = \array_map(
      static fn (array $forecast): HourlyForecast => HourlyForecast::fromArray($forecast),
      $data['data'],
    );

    $this->assertCount(3, $forecasts);

    $first = $forecasts[0];
    $this->assertEquals('2026-08-18T00:00:00+00:00', $first->getTime()->format(\DATE_RFC3339));
    $this->assertFalse($first->getIsNight());
    $this->assertEquals(15, $first->getTemp());
    $this->assertEquals(12, $first->getTempFeelsLike());
    $this->assertEquals(7, $first->getDewPoint());
    $this->assertEquals(61, $first->getRelativeHumidity());
    $this->assertEquals('mostly_sunny', $first->getIconDescriptor());
    $this->assertEquals(2, $first->getUv());

    $wind = $first->getWind();
    $this->assertEquals('NE', $wind->getDirection());
    $this->assertEquals(15, $wind->getSpeedKilometre());
    $this->assertEquals(24, $wind->getGustSpeedKilometre());

    $rain = $first->getRain();
    $this->assertEquals(0, $rain->getAmountMin());
    $this->assertNull($rain->getAmountMax());
    $this->assertEquals(0, $rain->getChance());
  }

}
