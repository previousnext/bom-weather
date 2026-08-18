<?php

declare(strict_types=1);

namespace BomWeather\Observation;

/**
 * A value object for the observation station.
 */
final class Station {

  /**
   * The BOM station ID.
   */
  protected ?string $bomId = NULL;

  /**
   * The station name.
   */
  protected ?string $name = NULL;

  /**
   * The distance from the location, in metres.
   */
  protected ?int $distance = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $station = new self();
    $station->bomId = $data['bom_id'] ?? NULL;
    $station->name = $data['name'] ?? NULL;
    $station->distance = $data['distance'] ?? NULL;
    return $station;
  }

  /**
   * Gets the BOM station ID.
   */
  public function getBomId(): ?string {
    return $this->bomId;
  }

  /**
   * Gets the station name.
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * Gets the distance from the location, in metres.
   */
  public function getDistance(): ?int {
    return $this->distance;
  }

}
