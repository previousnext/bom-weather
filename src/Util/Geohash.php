<?php

declare(strict_types=1);

namespace BomWeather\Util;

/**
 * Encodes latitude/longitude coordinates as a geohash.
 */
final class Geohash {

  /**
   * The base32 alphabet used by the geohash algorithm.
   */
  private const BASE32 = '0123456789bcdefghjkmnpqrstuvwxyz';

  /**
   * Encodes a latitude/longitude pair as a geohash.
   *
   * @param float $latitude
   *   The latitude.
   * @param float $longitude
   *   The longitude.
   * @param int $precision
   *   (optional) The number of characters in the resulting geohash.
   *
   * @return string
   *   The geohash.
   */
  public static function encode(float $latitude, float $longitude, int $precision = 7): string {
    $latRange = [-90.0, 90.0];
    $lonRange = [-180.0, 180.0];

    $geohash = '';
    $isEvenBit = TRUE;
    $bit = 0;
    $char = 0;

    while (\strlen($geohash) < $precision) {
      if ($isEvenBit) {
        $mid = ($lonRange[0] + $lonRange[1]) / 2;
        if ($longitude >= $mid) {
          $char |= (1 << (4 - $bit));
          $lonRange[0] = $mid;
        }
        else {
          $lonRange[1] = $mid;
        }
      }
      else {
        $mid = ($latRange[0] + $latRange[1]) / 2;
        if ($latitude >= $mid) {
          $char |= (1 << (4 - $bit));
          $latRange[0] = $mid;
        }
        else {
          $latRange[1] = $mid;
        }
      }

      $isEvenBit = !$isEvenBit;

      if ($bit < 4) {
        $bit++;
      }
      else {
        $geohash .= self::BASE32[$char];
        $bit = 0;
        $char = 0;
      }
    }

    return $geohash;
  }

}
