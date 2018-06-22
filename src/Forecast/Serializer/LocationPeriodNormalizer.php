<?php

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\LocationForecastPeriod;

/**
 * Location period normalizer.
 */
class LocationPeriodNormalizer extends BaseNormalizer {

  protected $supportedInterfaceOrClass = LocationForecastPeriod::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $class, $format = NULL, array $context = []) {
    $period = LocationForecastPeriod::create()
      ->setStartTime($this->serializer->denormalize($data['@start-time-utc'], \DateTime::class))
      ->setEndTime($this->serializer->denormalize($data['@end-time-utc'], \DateTime::class));

    if (isset($data['text'])) {
      if ($this->isAssoc($data['text'])) {
        $text = $data['text'];
        $this->setTextValue($text, $period);
      }
      array_map(function ($text) use ($period) {
        $this->setTextValue($text, $period);
      }, $data['text'], [$period]);
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
   * @param \BomWeather\Forecast\LocationForecastPeriod $period
   *   The period.
   */
  protected function setElementValue(array $element, LocationForecastPeriod $period) {
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
   * @param \BomWeather\Forecast\LocationForecastPeriod $period
   *   The period.
   */
  public function setTextValue(array $text, LocationForecastPeriod $period): void {
    switch ($text['@type']) {
      case 'precis':
        $period->setPrecis($text['#']);
        break;

      case 'probability_of_precipitation':
        $period->setProbabilityOfPrecipitation($text['#']);
        break;
    }
  }

}
