<?php

namespace BomWeather\Forecast;

/**
 * A value object for forecast areas.
 */
abstract class Area {

  /**
   * Location type.
   */
  const TYPE_LOCATION = 'location';

  /**
   * Metropolitan type.
   */
  const TYPE_METROPOLITAN = 'metropolitan';

  /**
   * Region type.
   */
  const TYPE_REGION = 'region';

  /**
   * The unique AAC identifier.
   *
   * @var string
   */
  protected $aac;

  /**
   * The area type.
   *
   * @var string
   */
  protected $type;

  /**
   * The description.
   *
   * @var string
   */
  protected $description;

  /**
   * The forecast periods.
   *
   * @var \BomWeather\ForecastPeriod[]
   */
  protected $periods;

}
