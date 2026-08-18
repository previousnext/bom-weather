<?php

declare(strict_types=1);

namespace BomWeather\Tests\Unit\Util;

use BomWeather\Util\Geohash;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Geohash utility.
 */
#[CoversClass(Geohash::class)]
class GeohashTest extends TestCase {

  /**
   * Tests encoding against the standard geohash reference test vector.
   */
  public function testEncode(): void {
    $this->assertEquals('u4pruydqqvj', Geohash::encode(57.64911, 10.40744, 11));
  }

  /**
   * Tests encoding at the 6-character precision the API requires.
   *
   * Uses Melbourne's real coordinates as returned by the /locations
   * endpoint.
   */
  public function testEncodeSixCharacterPrecision(): void {
    $this->assertEquals('r1r0fu', Geohash::encode(-37.81219482421875, 144.9700927734375, 6));
  }

}
