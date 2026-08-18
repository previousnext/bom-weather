<?php

declare(strict_types=1);

namespace BomWeather\Tests;

/**
 * Provides access to test fixture files.
 */
trait FixtureTrait {

  /**
   * Reads a fixture file's contents.
   *
   * @param string $name
   *   The fixture filename, relative to tests/fixtures.
   */
  protected function readFixture(string $name): string {
    $path = __DIR__ . "/../fixtures/$name";
    $contents = \file_get_contents($path);
    if ($contents === FALSE) {
      throw new \RuntimeException("Unable to read fixture: $path");
    }
    return $contents;
  }

}
