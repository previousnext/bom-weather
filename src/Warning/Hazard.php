<?php

declare(strict_types=1);

namespace BomWeather\Warning;

use BomWeather\Forecast\Area;

/**
 * A value object for weather hazard.
 */
final class Hazard {

  /**
   * The hazard type code.
   */
  protected ?string $type = NULL;

  /**
   * The hazard severity.
   */
  protected ?HazardSeverity $severity = NULL;

  /**
   * The hazard urgency.
   */
  protected ?HazardUrgency $urgency = NULL;

  /**
   * The hazard certainty.
   */
  protected ?HazardCertainty $certainty = NULL;

  /**
   * The hazard priority.
   */
  protected ?string $priority = NULL;

  /**
   * The warning phenomena text.
   */
  protected ?string $phenomena = NULL;

  /**
   * The warning areas text.
   */
  protected ?string $areas = NULL;

  /**
   * The affected areas.
   *
   * @var \BomWeather\Forecast\Area[]
   */
  protected array $affectedAreas = [];

  /**
   * Gets the hazard type code.
   */
  public function getType(): ?string {
    return $this->type;
  }

  /**
   * Sets the hazard type code.
   */
  public function setType(?string $type): Hazard {
    $this->type = $type;
    return $this;
  }

  /**
   * Gets the severity.
   */
  public function getSeverity(): ?HazardSeverity {
    return $this->severity;
  }

  /**
   * Sets the severity.
   */
  public function setSeverity(?HazardSeverity $severity): Hazard {
    $this->severity = $severity;
    return $this;
  }

  /**
   * Gets the urgency.
   */
  public function getUrgency(): ?HazardUrgency {
    return $this->urgency;
  }

  /**
   * Sets the urgency.
   */
  public function setUrgency(?HazardUrgency $urgency): Hazard {
    $this->urgency = $urgency;
    return $this;
  }

  /**
   * Gets the certainty.
   */
  public function getCertainty(): ?HazardCertainty {
    return $this->certainty;
  }

  /**
   * Sets the certainty.
   */
  public function setCertainty(?HazardCertainty $certainty): Hazard {
    $this->certainty = $certainty;
    return $this;
  }

  /**
   * Gets the priority.
   */
  public function getPriority(): ?string {
    return $this->priority;
  }

  /**
   * Sets the priority.
   */
  public function setPriority(?string $priority): Hazard {
    $this->priority = $priority;
    return $this;
  }

  /**
   * Gets the phenomena text.
   */
  public function getPhenomena(): ?string {
    return $this->phenomena;
  }

  /**
   * Sets the phenomena text.
   */
  public function setPhenomena(?string $phenomena): Hazard {
    $this->phenomena = $phenomena;
    return $this;
  }

  /**
   * Gets the areas text.
   */
  public function getAreas(): ?string {
    return $this->areas;
  }

  /**
   * Sets the areas text.
   */
  public function setAreas(?string $areas): Hazard {
    $this->areas = $areas;
    return $this;
  }

  /**
   * Gets the affected areas.
   *
   * @return \BomWeather\Forecast\Area[]
   *   The affected areas.
   */
  public function getAffectedAreas(): array {
    return $this->affectedAreas;
  }

  /**
   * Sets the affected areas.
   *
   * @param \BomWeather\Forecast\Area[] $affectedAreas
   *   The affected areas.
   */
  public function setAffectedAreas(array $affectedAreas): Hazard {
    $this->affectedAreas = $affectedAreas;
    return $this;
  }

  /**
   * Adds an affected area.
   */
  public function addAffectedArea(Area $area): Hazard {
    $this->affectedAreas[] = $area;
    return $this;
  }

}
