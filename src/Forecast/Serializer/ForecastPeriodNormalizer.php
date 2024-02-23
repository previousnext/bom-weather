<?php

declare(strict_types=1);

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\ForecastPeriod;
use BomWeather\Trait\WeatherDataAccessorTrait;
use BomWeather\Util\BaseNormalizer;

/**
 * Location period normalizer.
 */
class ForecastPeriodNormalizer extends BaseNormalizer {

  use WeatherDataAccessorTrait;

  protected string|array $supportedInterfaceOrClass = ForecastPeriod::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $type, $format = NULL, array $context = []) {
    $period = (new ForecastPeriod())
      ->setStartTime($this->serializer->denormalize($data['@start-time-utc'], \DateTimeImmutable::class))
      ->setEndTime($this->serializer->denormalize($data['@end-time-utc'], \DateTimeImmutable::class));

    if (isset($data['text'])) {
      if ($this->isAssoc($data['text'])) {
        $text = $data['text'];
        $this->setTextValue($text, $period);
      }
      else {
        \array_map(function ($text) use ($period): void {
          $this->setTextValue($text, $period);
        }, $data['text'], [$period]);
      }
    }

    if (isset($data['element'])) {
      if ($this->isAssoc($data['element'])) {
        $element = $data['element'];
        $this->setElementValue($element, $period);
      }
      else {
        \array_map(function ($element) use ($period): void {
          $this->setElementValue($element, $period);
        }, $data['element'], [$period]);
      }
    }
    return $period;
  }

  /**
   * Set an element value.
   *
   * @param array $element
   *   The element array.
   * @param \BomWeather\Forecast\ForecastPeriod $period
   *   The period.
   */
  protected function setElementValue(array $element, ForecastPeriod $period): void {
    $value = $this->accessWeatherData($element, '#');
    match ($element['@type']) {
      'forecast_icon_code' => $period->setIconCode($value),
      'air_temperature_minimum' => $period->setAirTempMinimum((int) $value),
      'air_temperature_maximum' => $period->setAirTempMaximum((int) $value),
      'precipitation_range' => $period->setPrecipitationRange($value),
      default => '',
    };
  }

  /**
   * Sets a text value.
   *
   * @param array $text
   *   The text array.
   * @param \BomWeather\Forecast\ForecastPeriod $period
   *   The period.
   */
  public function setTextValue(array $text, ForecastPeriod $period): void {
    $value = $this->accessWeatherData($text, '#');
    match ($text['@type']) {
      'precis' => $period->setPrecis($value),
      'probability_of_precipitation' => $period->setProbabilityOfPrecipitation($value),
      'forecast' => $period->setForecast($value),
      'uv_alert' => $period->setUvAlert($value),
      'forecast_seas' => $period->setSeas($value),
      'forecast_swell1' => $period->setSwell($value),
      'forecast_weather' => $period->setWeather($value),
      'forecast_winds' => $period->setWinds($value),
      'fire_danger' => $period->setFireDanger($value),
      default => '',
    };
  }

}
