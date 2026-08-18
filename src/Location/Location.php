<?php

declare(strict_types=1);

namespace BomWeather\Location;

/**
 * Value object for a location.
 */
final class Location {

  /**
   * The geohash.
   */
  protected ?string $geohash = NULL;

  /**
   * The location ID.
   */
  protected ?string $id = NULL;

  /**
   * The location name.
   */
  protected ?string $name = NULL;

  /**
   * The postcode.
   */
  protected ?string $postcode = NULL;

  /**
   * The state.
   */
  protected ?string $state = NULL;

  /**
   * The timezone.
   */
  protected ?string $timezone = NULL;

  /**
   * The latitude.
   */
  protected ?float $latitude = NULL;

  /**
   * The longitude.
   */
  protected ?float $longitude = NULL;

  /**
   * The marine area ID.
   */
  protected ?string $marineAreaId = NULL;

  /**
   * The tidal point.
   */
  protected ?string $tidalPoint = NULL;

  /**
   * Whether this location has wave data.
   */
  protected ?bool $hasWave = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $location = new self();
    $location->geohash = $data['geohash'] ?? NULL;
    $location->id = $data['id'] ?? NULL;
    $location->name = $data['name'] ?? NULL;
    $location->postcode = $data['postcode'] ?? NULL;
    $location->state = $data['state'] ?? NULL;
    $location->timezone = $data['timezone'] ?? NULL;
    $location->latitude = $data['latitude'] ?? NULL;
    $location->longitude = $data['longitude'] ?? NULL;
    $location->marineAreaId = $data['marine_area_id'] ?? NULL;
    $location->tidalPoint = $data['tidal_point'] ?? NULL;
    $location->hasWave = $data['has_wave'] ?? NULL;
    return $location;
  }

  /**
   * Gets the geohash.
   */
  public function getGeohash(): ?string {
    return $this->geohash;
  }

  /**
   * Gets the ID.
   */
  public function getId(): ?string {
    return $this->id;
  }

  /**
   * Gets the name.
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * Gets the postcode.
   */
  public function getPostcode(): ?string {
    return $this->postcode;
  }

  /**
   * Gets the state.
   */
  public function getState(): ?string {
    return $this->state;
  }

  /**
   * Gets the timezone.
   */
  public function getTimezone(): ?string {
    return $this->timezone;
  }

  /**
   * Gets the latitude.
   */
  public function getLatitude(): ?float {
    return $this->latitude;
  }

  /**
   * Gets the longitude.
   */
  public function getLongitude(): ?float {
    return $this->longitude;
  }

  /**
   * Gets the marine area ID.
   */
  public function getMarineAreaId(): ?string {
    return $this->marineAreaId;
  }

  /**
   * Gets the tidal point.
   */
  public function getTidalPoint(): ?string {
    return $this->tidalPoint;
  }

  /**
   * Gets whether this location has wave data.
   */
  public function getHasWave(): ?bool {
    return $this->hasWave;
  }

}
