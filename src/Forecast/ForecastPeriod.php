<?php

namespace BomWeather\Forecast;

/**
 * A value object for forecast periods.
 */
class ForecastPeriod {

  /**
   * The start time.
   *
   * @var \DateTime
   */
  protected $startTime;

  /**
   * The end time.
   *
   * @var \DateTime
   */
  protected $endTime;

  /**
   * Gets the start time.
   *
   * @return \DateTime
   *   The start time.
   */
  public function getStartTime(): \DateTime {
    return $this->startTime;
  }

  /**
   * Sets the start time.
   *
   * @param \DateTime $startTime
   *   The start time.
   *
   * @return $this
   */
  public function setStartTime(\DateTime $startTime): ForecastPeriod {
    $this->startTime = $startTime;
    return $this;
  }

  /**
   * Gets the end time.
   *
   * @return \DateTime
   *   The end time.
   */
  public function getEndTime(): \DateTime {
    return $this->endTime;
  }

  /**
   * Sets the end time.
   *
   * @param \DateTime $endTime
   *   The end time.
   *
   * @return $this
   */
  public function setEndTime(\DateTime $endTime): ForecastPeriod {
    $this->endTime = $endTime;
    return $this;
  }

}
