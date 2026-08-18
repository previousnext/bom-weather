<?php

declare(strict_types=1);

namespace BomWeather\Warning;

/**
 * A value object for a weather warning.
 */
final class Warning {

  /**
   * The warning ID.
   */
  protected ?string $id = NULL;

  /**
   * The area ID. Only present when listed for a location.
   */
  protected ?string $areaId = NULL;

  /**
   * The warning type, e.g. "severe_weather_warning".
   */
  protected ?string $type = NULL;

  /**
   * The warning title.
   */
  protected ?string $title = NULL;

  /**
   * The warning short title.
   */
  protected ?string $shortTitle = NULL;

  /**
   * The state the warning applies to.
   */
  protected ?string $state = NULL;

  /**
   * The warning group type, e.g. "major" or "minor".
   *
   * Only present when listed for a location.
   */
  protected ?string $warningGroupType = NULL;

  /**
   * The issue time.
   */
  protected ?\DateTimeImmutable $issueTime = NULL;

  /**
   * The expiry time.
   */
  protected ?\DateTimeImmutable $expiryTime = NULL;

  /**
   * The warning phase, e.g. "new", "update", "cancelled".
   */
  protected ?string $phase = NULL;

  /**
   * The full warning message, as HTML.
   *
   * Only present when fetching a single warning by ID.
   */
  protected ?string $message = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $warning = new self();
    $warning->id = $data['id'] ?? NULL;
    $warning->areaId = $data['area_id'] ?? NULL;
    $warning->type = $data['type'] ?? NULL;
    $warning->title = $data['title'] ?? NULL;
    $warning->shortTitle = $data['short_title'] ?? NULL;
    $warning->state = $data['state'] ?? NULL;
    $warning->warningGroupType = $data['warning_group_type'] ?? NULL;

    if (!empty($data['issue_time'])) {
      $warning->issueTime = new \DateTimeImmutable($data['issue_time']);
    }
    if (!empty($data['expiry_time'])) {
      $warning->expiryTime = new \DateTimeImmutable($data['expiry_time']);
    }

    $warning->phase = $data['phase'] ?? NULL;
    $warning->message = $data['message'] ?? NULL;

    return $warning;
  }

  /**
   * Gets the warning ID.
   */
  public function getId(): ?string {
    return $this->id;
  }

  /**
   * Gets the area ID.
   */
  public function getAreaId(): ?string {
    return $this->areaId;
  }

  /**
   * Gets the warning type.
   */
  public function getType(): ?string {
    return $this->type;
  }

  /**
   * Gets the warning title.
   */
  public function getTitle(): ?string {
    return $this->title;
  }

  /**
   * Gets the warning short title.
   */
  public function getShortTitle(): ?string {
    return $this->shortTitle;
  }

  /**
   * Gets the state the warning applies to.
   */
  public function getState(): ?string {
    return $this->state;
  }

  /**
   * Gets the warning group type.
   */
  public function getWarningGroupType(): ?string {
    return $this->warningGroupType;
  }

  /**
   * Gets the issue time.
   */
  public function getIssueTime(): ?\DateTimeImmutable {
    return $this->issueTime;
  }

  /**
   * Gets the expiry time.
   */
  public function getExpiryTime(): ?\DateTimeImmutable {
    return $this->expiryTime;
  }

  /**
   * Gets the warning phase.
   */
  public function getPhase(): ?string {
    return $this->phase;
  }

  /**
   * Gets the full warning message, as HTML.
   */
  public function getMessage(): ?string {
    return $this->message;
  }

}
