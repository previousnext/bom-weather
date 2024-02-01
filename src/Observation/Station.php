<?php

declare(strict_types=1);

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
   * The station ID.
   */
  protected ?int $wmoId = NULL;

  /**
   * The station ID.
   */
  protected string|int|null $bomId = NULL;

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

  /**
   * Gets the BOM ID.
   */
  public function getBomId(): ?int {
    return $this->bomId;
  }

  /**
   * Sets the BOM ID.
   */
  public function setBomId(string|int $id): self {
    $this->bomId = $id;
    return $this;
  }

  /**
   * Gets the WMO ID.
   */
  public function getWmoId(): ?int {
    return $this->wmoId;
  }

  /**
   * Sets the Wmo ID.
   */
  public function setWmoId(int $id): self {
    $this->wmoId = $id;
    return $this;
  }

}
