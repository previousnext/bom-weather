<?php

namespace BomWeather\Observation;

/**
 * A value object for a weather observation station.
 */
class Station {

  /**
   * The station ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The station name.
   *
   * @var string
   */
  protected $name;

  /**
   * The latitude.
   *
   * @var float
   */
  protected $latitude;

  /**
   * The longitude.
   *
   * @var float
   */
  protected $longitude;

  /**
   * Factory method.
   *
   * @return $this
   */
  public static function create() {
    return new static();
  }

  /**
   * Gets the Name.
   *
   * @return string
   *   The Name.
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Sets the Name.
   *
   * @param string $name
   *   The Name.
   *
   * @return $this
   */
  public function setName(string $name): Station {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets the Latitude.
   *
   * @return float
   *   The Latitude.
   */
  public function getLatitude(): float {
    return $this->latitude;
  }

  /**
   * Sets the Latitude.
   *
   * @param float $latitude
   *   The Latitude.
   *
   * @return $this
   */
  public function setLatitude(float $latitude): Station {
    $this->latitude = $latitude;
    return $this;
  }

  /**
   * Gets the Longitude.
   *
   * @return float
   *   The Longitude.
   */
  public function getLongitude(): float {
    return $this->longitude;
  }

  /**
   * Sets the Longitude.
   *
   * @param float $longitude
   *   The Longitude.
   *
   * @return $this
   */
  public function setLongitude(float $longitude): Station {
    $this->longitude = $longitude;
    return $this;
  }

  /**
   * Gets the Id.
   *
   * @return string
   *   The Id.
   */
  public function getId(): string {
    return $this->id;
  }

  /**
   * Sets the Id.
   *
   * @param string $id
   *   The Id.
   *
   * @return $this
   */
  public function setId(string $id): Station {
    $this->id = $id;
    return $this;
  }

}
