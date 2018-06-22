<?php

namespace BomWeather\Forecast\Serializer;

use BomWeather\Forecast\RegionForecastPeriod;

/**
 * Region period normalizer.
 */
class RegionPeriodNormalizer extends BaseNormalizer {

  protected $supportedInterfaceOrClass = RegionForecastPeriod::class;

  /**
   * {@inheritdoc}
   */
  public function denormalize($data, $class, $format = NULL, array $context = []) {
    $period = RegionForecastPeriod::create()
      ->setStartTime($this->serializer->denormalize($data['@start-time-utc'], \DateTime::class))
      ->setEndTime($this->serializer->denormalize($data['@end-time-utc'], \DateTime::class));

    array_map(function ($text) use ($period) {
      if ($text['@type'] === 'forecast') {
        $period->setForecast($text['#']);
      }
    }, $data['text'], [$period]);
    return $period;
  }

}
