<?php

namespace BomWeather\Forecast;

/**
 * A value object for forecast periods.
 */
abstract class ForecastPeriod {

  /**
   * The start time.
   *
   * @var string
   */
  protected $startTime;

  /**
   * The end time.
   *
   * @var string
   */
  protected $endTime;

  /**
   * The synoptic situation.
   *
   * @var string
   */
  protected $synoptic;

  /**
   * The winds.
   *
   * @var string
   */
  protected $winds;

  /**
   * The seas.
   *
   * @var string
   */
  protected $seas;

  /**
   * The swell.
   *
   * @var string
   */
  protected $swell;

  /**
   * The weather.
   *
   * @var string
   */
  protected $weather;

  /**
   * The forecast.
   *
   * @var string
   */
  protected $forecast;

}
