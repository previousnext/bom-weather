<?php

declare(strict_types=1);

namespace BomWeather\Warning;

/**
 * Hazard certainty levels.
 */
enum HazardCertainty: string {

  case Observed = 'OBS';
  case Likely = 'LIK';
  case Possible = 'POS';
  case Unlikely = 'UNL';
  case Unknown = 'UNK';

}
