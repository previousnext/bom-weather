<?php

namespace BomWeather\Observation;

/**
 * Value object for an observation.
 */
class Observation {

  /**
   * The date time.
   *
   * @var \DateTime
   */
  protected $dateTime;

  /**
   * The weather station.
   *
   * @var \BomWeather\Observation\Station
   */
  protected $station;

  /**
   * The temperature observation.
   *
   * @var \BomWeather\Observation\Temperature
   */
  protected $temperature;

  /**
   * The wind observation.
   *
   * @var \BomWeather\Observation\Wind
   */
  protected $wind;

  /**
   * The pressure observation.
   *
   * @var \BomWeather\Observation\Pressure
   */
  protected $pressure;

  /**
   * The rain since 9am, in millimetres.
   *
   * @var int
   */
  protected $rainSince9am;

  /**
   * Factory method.
   *
   * @return $this
   */
  public static function create() {
    return new static();
  }

  /**
   * Gets the DateTime.
   *
   * @return \DateTime
   *   The DateTime.
   */
  public function getDateTime(): \DateTime {
    return $this->dateTime;
  }

  /**
   * Sets the DateTime.
   *
   * @param \DateTime $dateTime
   *   The DateTime.
   *
   * @return $this
   */
  public function setDateTime(\DateTime $dateTime): Observation {
    $this->dateTime = $dateTime;
    return $this;
  }

  /**
   * Gets the Station.
   *
   * @return \BomWeather\Observation\Station
   *   The Station.
   */
  public function getStation(): Station {
    return $this->station;
  }

  /**
   * Sets the Station.
   *
   * @param \BomWeather\Observation\Station $station
   *   The Station.
   *
   * @return $this
   */
  public function setStation(Station $station): Observation {
    $this->station = $station;
    return $this;
  }

  /**
   * Gets the Temperature.
   *
   * @return \BomWeather\Observation\Temperature
   *   The Temperature.
   */
  public function getTemperature(): Temperature {
    return $this->temperature;
  }

  /**
   * Sets the Temperature.
   *
   * @param \BomWeather\Observation\Temperature $temperature
   *   The Temperature.
   *
   * @return $this
   */
  public function setTemperature(Temperature $temperature): Observation {
    $this->temperature = $temperature;
    return $this;
  }

  /**
   * Gets the Wind.
   *
   * @return \BomWeather\Observation\Wind
   *   The Wind.
   */
  public function getWind(): Wind {
    return $this->wind;
  }

  /**
   * Sets the Wind.
   *
   * @param \BomWeather\Observation\Wind $wind
   *   The Wind.
   *
   * @return $this
   */
  public function setWind(Wind $wind): Observation {
    $this->wind = $wind;
    return $this;
  }

  /**
   * Gets the Pressure.
   *
   * @return \BomWeather\Observation\Pressure
   *   The Pressure.
   */
  public function getPressure(): Pressure {
    return $this->pressure;
  }

  /**
   * Sets the Pressure.
   *
   * @param \BomWeather\Observation\Pressure $pressure
   *   The Pressure.
   *
   * @return $this
   */
  public function setPressure(Pressure $pressure): Observation {
    $this->pressure = $pressure;
    return $this;
  }

  /**
   * Gets the RainSince9am.
   *
   * @return int
   *   The RainSince9am.
   */
  public function getRainSince9am(): int {
    return $this->rainSince9am;
  }

  /**
   * Sets the RainSince9am.
   *
   * @param int $rainSince9am
   *   The RainSince9am.
   *
   * @return $this
   */
  public function setRainSince9am(int $rainSince9am): Observation {
    $this->rainSince9am = $rainSince9am;
    return $this;
  }

}
