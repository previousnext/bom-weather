<?php

declare(strict_types=1);

namespace BomWeather\Trait;

/**
 * Trait to provide general data validation and access methods.
 */
trait WeatherDataAccessorTrait {

  /**
   * Access the weather data attribute from weather data array.
   *
   * @param array|null $weatherData
   *   Array of weather data.
   * @param string $key
   *   Array key to fetch the data.
   */
  public function accessWeatherData(?array $weatherData, string $key): mixed {
    if (!$weatherData) {
      return NULL;
    }
    if (!\array_key_exists($key, $weatherData)) {
      return '';
    }
    return $weatherData[$key] ?? '';
  }

}
