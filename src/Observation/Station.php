<?php

declare(strict_types = 1);

namespace BomWeather\Observation;

/**
 * A value object for a weather observation station.
 */
final class Station {

  /**
   * The station ID.
   */
  protected ?int $id = NULL;

  /**
   * The station name.
   */
  protected ?string $name = NULL;

  /**
   * The latitude.
   */
  protected ?float $latitude = NULL;

  /**
   * The longitude.
   */
  protected ?float $longitude = NULL;

  /**
   * Factory method.
   */
  public static function create(): Station {
    return new Station();
  }

  /**
   * Gets the Name.
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * Sets the Name.
   */
  public function setName(string $name): self {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets the Latitude.
   */
  public function getLatitude(): ?float {
    return $this->latitude;
  }

  /**
   * Sets the Latitude.
   */
  public function setLatitude(float $latitude): self {
    $this->latitude = $latitude;
    return $this;
  }

  /**
   * Gets the Longitude.
   */
  public function getLongitude(): ?float {
    return $this->longitude;
  }

  /**
   * Sets the Longitude.
   */
  public function setLongitude(float $longitude): self {
    $this->longitude = $longitude;
    return $this;
  }

  /**
   * Gets the Id.
   */
  public function getId(): ?int {
    return $this->id;
  }

  /**
   * Sets the Id.
   */
  public function setId(int $id): self {
    $this->id = $id;
    return $this;
  }

}
