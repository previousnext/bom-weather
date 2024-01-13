<?php

declare(strict_types = 1);

namespace BomWeather\Observation;

/**
 * Value object for an observation.
 */
final class Observation {

  /**
   * The date time.
   */
  protected ?\DateTimeImmutable $dateTime = NULL;

  /**
   * The weather station.
   */
  protected ?Station $station = NULL;

  /**
   * The temperature observation.
   */
  protected ?Temperature $temperature = NULL;

  /**
   * The wind observation.
   */
  protected ?Wind $wind = NULL;

  /**
   * The pressure observation.
   */
  protected ?Pressure $pressure = NULL;

  /**
   * The rain since 9am, in millimetres.
   */
  protected ?string $rainSince9am = NULL;

  /**
   * Gets the DateTime.
   */
  public function getDateTime(): ?\DateTimeImmutable {
    return $this->dateTime;
  }

  /**
   * Sets the DateTime.
   */
  public function setDateTime(\DateTimeImmutable $dateTime): self {
    $this->dateTime = $dateTime;
    return $this;
  }

  /**
   * Gets the Station.
   */
  public function getStation(): Station {
    return $this->station;
  }

  /**
   * Sets the Station.
   */
  public function setStation(Station $station): self {
    $this->station = $station;
    return $this;
  }

  /**
   * Gets the Temperature.
   */
  public function getTemperature(): ?Temperature {
    return $this->temperature;
  }

  /**
   * Sets the Temperature.
   */
  public function setTemperature(Temperature $temperature): ?Observation {
    $this->temperature = $temperature;
    return $this;
  }

  /**
   * Gets the Wind.
   */
  public function getWind(): ?Wind {
    return $this->wind;
  }

  /**
   * Sets the Wind.
   */
  public function setWind(Wind $wind): self {
    $this->wind = $wind;
    return $this;
  }

  /**
   * Gets the Pressure.
   */
  public function getPressure(): ?Pressure {
    return $this->pressure;
  }

  /**
   * Sets the Pressure.
   */
  public function setPressure(Pressure $pressure): self {
    $this->pressure = $pressure;
    return $this;
  }

  /**
   * Gets the RainSince9am.
   */
  public function getRainSince9am(): ?string {
    return $this->rainSince9am;
  }

  /**
   * Sets the RainSince9am.
   */
  public function setRainSince9am(string $rainSince9am): self {
    $this->rainSince9am = $rainSince9am;
    return $this;
  }

}
