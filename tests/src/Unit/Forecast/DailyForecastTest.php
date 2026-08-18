<?php

declare(strict_types=1);

namespace BomWeather\Tests\Unit\Forecast;

use BomWeather\Forecast\Astronomical;
use BomWeather\Forecast\DailyForecast;
use BomWeather\Forecast\DailyRain;
use BomWeather\Forecast\FireDangerCategory;
use BomWeather\Forecast\Now;
use BomWeather\Forecast\Uv;
use BomWeather\Tests\FixtureTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Tests the DailyForecast value object.
 */
#[CoversClass(DailyForecast::class)]
#[CoversClass(DailyRain::class)]
#[CoversClass(Uv::class)]
#[CoversClass(Astronomical::class)]
#[CoversClass(FireDangerCategory::class)]
#[CoversClass(Now::class)]
class DailyForecastTest extends TestCase {

  use FixtureTrait;

  /**
   * Tests hydration from an array of data.
   */
  public function testFromArray(): void {
    $json = $this->readFixture('daily-forecasts.json');
    $data = \json_decode($json, TRUE);

    $forecasts = \array_map(
      static fn (array $forecast): DailyForecast => DailyForecast::fromArray($forecast),
      $data['data'],
    );

    $this->assertCount(8, $forecasts);

    $today = $forecasts[0];
    $this->assertEquals('2026-08-17T14:00:00+00:00', $today->getDate()->format(\DATE_RFC3339));
    $this->assertEquals(19, $today->getTempMax());
    $this->assertEquals(9, $today->getTempMin());
    $this->assertEquals('shower', $today->getIconDescriptor());
    $this->assertEquals('Shower or two.', $today->getShortText());

    $rain = $today->getRain();
    $this->assertEquals(0, $rain->getAmountMin());
    $this->assertEquals(1, $rain->getAmountMax());
    $this->assertEquals('mm', $rain->getAmountUnits());
    $this->assertEquals(40, $rain->getChance());
    $this->assertEquals('medium', $rain->getChanceOfNoRainCategory());
    $this->assertEquals(1, $rain->getPrecipitationAmount25PercentChance());

    $uv = $today->getUv();
    $this->assertEquals('moderate', $uv->getCategory());
    $this->assertEquals(3, $uv->getMaxIndex());
    $this->assertEquals('2026-08-17T21:03:22+00:00', $today->getAstronomical()->getSunriseTime()->format(\DATE_RFC3339));

    $fireDangerCategory = $today->getFireDangerCategory();
    $this->assertNull($fireDangerCategory->getText());

    $now = $today->getNow();
    $this->assertNotNull($now);
    $this->assertEquals('Max', $now->getNowLabel());
    $this->assertEquals(19, $now->getTempNow());

    // Only the first entry has a "now" summary.
    $this->assertNull($forecasts[1]->getNow());

    // The last day's entry has several null fields.
    $lastDay = $forecasts[7];
    $this->assertNull($lastDay->getTempMax());
    $this->assertEquals(12, $lastDay->getTempMin());
    $this->assertNull($lastDay->getIconDescriptor());
  }

}
