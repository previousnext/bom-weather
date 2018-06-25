<?php

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\ForecastPeriod;
use BomWeather\Util\BaseNormalizer;

/**
 * Location period normalizer.
 */
class ForecastPeriodNormalizer extends BaseNormalizer {

  protected $supportedInterfaceOrClass = ForecastPeriod::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $class, $format = NULL, array $context = []) {
    $period = ForecastPeriod::create()
      ->setStartTime($this->serializer->denormalize($data['@start-time-utc'], \DateTime::class))
      ->setEndTime($this->serializer->denormalize($data['@end-time-utc'], \DateTime::class));

    if (isset($data['text'])) {
      if ($this->isAssoc($data['text'])) {
        $text = $data['text'];
        $this->setTextValue($text, $period);
      }
      else {
        array_map(function ($text) use ($period) {
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
        array_map(function ($element) use ($period) {
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
  protected function setElementValue(array $element, ForecastPeriod $period) {
    switch ($element['@type']) {
      case 'forecast_icon_code':
        $period->setIconCode($element['#']);
        break;

      case 'air_temperature_minimum':
        $period->setAirTempMinimum($element['#']);
        break;

      case 'air_temperature_maximum':
        $period->setAirTempMaximum($element['#']);
        break;

      case 'precipitation_range':
        $period->setPrecipitationRange($element['#']);
        break;

    }
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
    switch ($text['@type']) {
      case 'precis':
        $period->setPrecis($text['#']);
        break;

      case 'probability_of_precipitation':
        $period->setProbabilityOfPrecipitation($text['#']);
        break;

      case 'forecast':
        $period->setForecast($text['#']);
        break;

      case 'uv_alert':
        $period->setUvAlert($text['#']);
        break;

      case 'forecast_seas':
        $period->setSeas($text['#']);
        break;

      case 'forecast_swell1':
        $period->setSwell($text['#']);
        break;

      case 'forecast_weather':
        $period->setWeather($text['#']);
        break;

      case 'forecast_winds':
        $period->setWinds($text['#']);
        break;

    }
  }

}
