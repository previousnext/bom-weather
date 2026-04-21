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
   * @param array<string, mixed>|null $weatherData
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

  /**
   * Extracts text content, joining nested <p> tags with newlines.
   *
   * Handles structures like:
   * - Simple string: "text"
   * - Array with '#' key: ['#' => 'text']
   * - Array with 'p' key containing array: ['p' => ['line1', 'line2']]
   * - Array with 'p' key containing string: ['p' => 'text']
   *
   * @param mixed $data
   *   The data to extract text from.
   *
   * @return string|null
   *   The extracted text, or NULL if empty.
   */
  public function extractTextContent(mixed $data): ?string {
    if (\is_string($data)) {
      return $data;
    }

    if (!\is_array($data)) {
      return NULL;
    }

    // Check for direct '#' value.
    if (isset($data['#'])) {
      return \is_string($data['#']) ? $data['#'] : NULL;
    }

    // Check for 'p' tags (nested paragraphs).
    if (isset($data['p'])) {
      $paragraphs = $data['p'];
      if (\is_string($paragraphs)) {
        return $paragraphs;
      }
      if (\is_array($paragraphs)) {
        // Filter to only strings and join with newlines.
        $strings = \array_filter($paragraphs, 'is_string');
        return \implode("\n", $strings) ?: NULL;
      }
    }

    return NULL;
  }

}
