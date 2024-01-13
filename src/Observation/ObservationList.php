<?php

declare(strict_types=1);

namespace BomWeather\Observation;

/**
 * A value object for a list of observations.
 */
final class ObservationList {

  /**
   * The list of observations.
   *
   * @var \BomWeather\Observation\Observation[]
   */
  protected array $observations = [];

  /**
   * The refresh message.
   */
  protected ?string $refreshMessage = NULL;

  /**
   * Gets the Observations.
   *
   * @return \BomWeather\Observation\Observation[]
   *   The Observations.
   */
  public function getObservations(): array {
    return $this->observations;
  }

  /**
   * Sets the Observations.
   *
   * @param \BomWeather\Observation\Observation[] $observations
   *   The Observations.
   */
  public function setObservations(array $observations): self {
    $this->observations = $observations;
    return $this;
  }

  /**
   * Adds an observation.
   *
   * @param \BomWeather\Observation\Observation $observation
   *   The observation.
   */
  public function addObservation(Observation $observation): self {
    $this->observations[] = $observation;
    return $this;
  }

  /**
   * Gets the latest observation.
   *
   * @return \BomWeather\Observation\Observation|null
   *   The observation, or NULL if none.
   */
  public function getLatest(): ?Observation {
    if (!empty($this->observations)) {
      return $this->observations[0];
    }
    return NULL;
  }

  /**
   * Gets the Refresh Message.
   */
  public function getRefreshMessage(): ?string {
    return $this->refreshMessage;
  }

  /**
   * Sets the Refresh Message.
   */
  public function setRefreshMessage(string $refreshMessage): self {
    $this->refreshMessage = $refreshMessage;
    return $this;
  }

}
