<?php

declare(strict_types=1);

namespace BomWeather\Tests\Unit\Observation;

use BomWeather\Observation\Observation;
use BomWeather\Observation\Station;
use BomWeather\Observation\TimedValue;
use BomWeather\Observation\Wind;
use BomWeather\Tests\FixtureTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Observation value object.
 */
#[CoversClass(Observation::class)]
#[CoversClass(Wind::class)]
#[CoversClass(Station::class)]
#[CoversClass(TimedValue::class)]
class ObservationTest extends TestCase {

  use FixtureTrait;

  /**
   * Tests hydration from an array of data.
   */
  public function testFromArray(): void {
    $json = $this->readFixture('observation.json');
    $data = \json_decode($json, TRUE);

    $observation = Observation::fromArray($data['data']);

    $this->assertEquals(13.1, $observation->getTemp());
    $this->assertEquals(11.6, $observation->getTempFeelsLike());
    $this->assertEquals(0, $observation->getRainSince9am());
    $this->assertEquals(74, $observation->getHumidity());

    $wind = $observation->getWind();
    $this->assertEquals('N', $wind->getDirection());
    $this->assertEquals(6, $wind->getSpeedKilometre());
    $this->assertEquals(3, $wind->getSpeedKnot());

    $gust = $observation->getGust();
    $this->assertEquals(7, $gust->getSpeedKilometre());
    $this->assertEquals(4, $gust->getSpeedKnot());

    $maxGust = $observation->getMaxGust();
    $this->assertEquals(15, $maxGust->getSpeedKilometre());
    $this->assertEquals('2026-08-17T23:53:00+00:00', $observation->getMaxGustTime()->format(\DATE_RFC3339));

    $maxTemp = $observation->getMaxTemp();
    $this->assertEquals(13.3, $maxTemp->getValue());
    $this->assertEquals('2026-08-17T23:47:00+00:00', $maxTemp->getTime()->format(\DATE_RFC3339));

    $minTemp = $observation->getMinTemp();
    $this->assertEquals(6.8, $minTemp->getValue());

    $station = $observation->getStation();
    $this->assertEquals('086338', $station->getBomId());
    $this->assertEquals('Melbourne (Olympic Park)', $station->getName());
    $this->assertEquals(1791, $station->getDistance());
  }

}
