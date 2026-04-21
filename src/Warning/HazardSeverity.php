<?php

declare(strict_types=1);

namespace BomWeather\Warning;

/**
 * Hazard severity levels.
 */
enum HazardSeverity: string {

  case Extreme = 'EXT';
  case Severe = 'SEV';
  case Strong = 'STR';
  case Moderate = 'MOD';
  case Minor = 'MIN';
  case Unknown = 'UNK';

}
