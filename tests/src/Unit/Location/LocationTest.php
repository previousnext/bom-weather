<?php

declare(strict_types=1);

namespace BomWeather\Tests\Unit\Location;

use BomWeather\Location\Location;
use BomWeather\Tests\FixtureTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Location value object.
 */
#[CoversClass(Location::class)]
class LocationTest extends TestCase {

  use FixtureTrait;

  /**
   * Tests hydration from an array of data.
   */
  public function testFromArray(): void {
    $json = $this->readFixture('location.json');
    $data = \json_decode($json, TRUE);

    $location = Location::fromArray($data['data']);

    $this->assertEquals('r1r0fu', $location->getGeohash());
    $this->assertEquals('Melbourne-r1r0fu', $location->getId());
    $this->assertEquals('Melbourne', $location->getName());
    $this->assertEquals('VIC', $location->getState());
    $this->assertEquals('Australia/Melbourne', $location->getTimezone());
    $this->assertEqualsWithDelta(-37.812, $location->getLatitude(), 0.001);
    $this->assertEqualsWithDelta(144.970, $location->getLongitude(), 0.001);
    $this->assertEquals('VIC_MW005', $location->getMarineAreaId());
    $this->assertEquals('VIC_TP027', $location->getTidalPoint());
    $this->assertFalse($location->getHasWave());
  }

}
