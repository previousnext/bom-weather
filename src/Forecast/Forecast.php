<?php

namespace BomWeather\Forecast;

/**
 * A value object for weather forcasts.
 */
class Forecast {

  /**
   * The regions.
   *
   * @var \BomWeather\Forecast\Region[]
   */
  protected $regions = [];

  /**
   * The metropolitan areas.
   *
   * @var \BomWeather\Forecast\MetropolitanArea[]
   */
  protected $metropolitanAreas = [];

  /**
   * The locations.
   *
   * @var \BomWeather\Forecast\Location[]
   */
  protected $locations = [];

  /**
   * The issue time.
   *
   * @var \DateTime
   */
  protected $issueTime;

  /**
   * Factory method.
   *
   * @return $this
   */
  public static function create() {
    return new static();
  }

  /**
   * Gets the regions.
   *
   * @return \BomWeather\Forecast\Region[]
   *   The regions.
   */
  public function getRegions(): array {
    return $this->regions;
  }

  /**
   * Sets the regions.
   *
   * @param \BomWeather\Forecast\Region[] $regions
   *   The regions.
   *
   * @return $this
   */
  public function setRegions(array $regions): Forecast {
    $this->regions = $regions;
    return $this;
  }

  /**
   * Adds a region.
   *
   * @param \BomWeather\Forecast\Region $region
   *   The region.
   *
   * @return $this
   */
  public function addRegion(Region $region): Forecast {
    $this->regions[] = $region;
    return $this;
  }

  /**
   * Gets the metropolitan areas.
   *
   * @return \BomWeather\Forecast\MetropolitanArea[]
   *   The metropolitan areas.
   */
  public function getMetropolitanAreas(): array {
    return $this->metropolitanAreas;
  }

  /**
   * Sets the metropolitan areas.
   *
   * @param \BomWeather\Forecast\MetropolitanArea[] $metropolitanAreas
   *   The metropolitan areas.
   *
   * @return $this
   */
  public function setMetropolitanAreas(array $metropolitanAreas): Forecast {
    $this->metropolitanAreas = $metropolitanAreas;
    return $this;
  }

  /**
   * Adds a metropolitan area.
   *
   * @param \BomWeather\Forecast\MetropolitanArea $metropolitanArea
   *   The metropolitan area.
   *
   * @return $this
   */
  public function addMetropolitanArea(MetropolitanArea $metropolitanArea): Forecast {
    $this->metropolitanAreas[] = $metropolitanArea;
    return $this;
  }

  /**
   * Gets the locations.
   *
   * @return \BomWeather\Forecast\Location[]
   *   The locations.
   */
  public function getLocations(): array {
    return $this->locations;
  }

  /**
   * Sets the locations.
   *
   * @param \BomWeather\Forecast\Location[] $locations
   *   The locations.
   *
   * @return $this
   */
  public function setLocations(array $locations): Forecast {
    $this->locations = $locations;
    return $this;
  }

  /**
   * Adds a location.
   *
   * @param \BomWeather\Forecast\Location $location
   *   The location.
   *
   * @return $this
   */
  public function addLocation(Location $location): Forecast {
    $this->locations[] = $location;
    return $this;
  }

  /**
   * Gets the issue time.
   *
   * @return \DateTime
   *   The issue time.
   */
  public function getIssueTime(): \DateTime {
    return $this->issueTime;
  }

  /**
   * Sets the issue time.
   *
   * @param \DateTime $issueTime
   *   The issue time.
   *
   * @return $this
   */
  public function setIssueTime(\DateTime $issueTime): Forecast {
    $this->issueTime = $issueTime;
    return $this;
  }

}
