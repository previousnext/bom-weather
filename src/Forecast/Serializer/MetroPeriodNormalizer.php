<?php

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\MetropolitanForecastPeriod;

/**
 * Metro period normalizer.
 */
class MetroPeriodNormalizer extends BaseNormalizer {

  protected $supportedInterfaceOrClass = MetropolitanForecastPeriod::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $class, $format = NULL, array $context = []) {
    $period = MetropolitanForecastPeriod::create()
      ->setStartTime($this->serializer->denormalize($data['@start-time-utc'], \DateTime::class))
      ->setEndTime($this->serializer->denormalize($data['@end-time-utc'], \DateTime::class));

    if ($this->isAssoc($data['text'])) {
      $text = $data['text'];
      $this->setValue($text, $period);
    }
    else {
      array_map(function ($text) use ($period) {
        $this->setValue($text, $period);
      }, $data['text'], [$period]);
    }
    return $period;
  }

  /**
   * Sets the appropriate text value.
   *
   * @param array $text
   *   The text array.
   * @param \BomWeather\Forecast\MetropolitanForecastPeriod $period
   *   The period.
   */
  public function setValue(array $text, MetropolitanForecastPeriod $period): void {
    switch ($text['@type']) {
      case 'forecast':
        $period->setForecast($text['#']);
        break;

      case 'uv_alert':
        $period->setUvAlert($text['#']);
        break;
    }
  }

}
