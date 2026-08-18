<?php

declare(strict_types=1);

namespace BomWeather\Forecast;

/**
 * Value object for a fire danger category.
 */
final class FireDangerCategory {

  /**
   * The category text, e.g. "Extreme".
   */
  protected ?string $text = NULL;

  /**
   * The default colour for this category.
   */
  protected ?string $defaultColour = NULL;

  /**
   * The dark mode colour for this category.
   */
  protected ?string $darkModeColour = NULL;

  /**
   * Creates a new instance from an array of data.
   *
   * @param array<string, mixed> $data
   *   The data.
   */
  public static function fromArray(array $data): self {
    $category = new self();
    $category->text = $data['text'] ?? NULL;
    $category->defaultColour = $data['default_colour'] ?? NULL;
    $category->darkModeColour = $data['dark_mode_colour'] ?? NULL;
    return $category;
  }

  /**
   * Gets the category text.
   */
  public function getText(): ?string {
    return $this->text;
  }

  /**
   * Gets the default colour for this category.
   */
  public function getDefaultColour(): ?string {
    return $this->defaultColour;
  }

  /**
   * Gets the dark mode colour for this category.
   */
  public function getDarkModeColour(): ?string {
    return $this->darkModeColour;
  }

}
