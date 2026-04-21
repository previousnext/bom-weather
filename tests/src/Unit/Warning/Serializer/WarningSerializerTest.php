<?php

declare(strict_types=1);

namespace BomWeather\Tests\Unit\Warning\Serializer;

use BomWeather\Warning\Serializer\WarningSerializerFactory;
use BomWeather\Warning\Warning;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Tests the warning serializer.
 */
#[CoversClass(WarningSerializerFactory::class)]
class WarningSerializerTest extends TestCase {

  /**
   * Tests deserialization of NSW marine warning data.
   */
  public function testDeserializeMarineWarning(): void {
    $factory = new WarningSerializerFactory();
    $serializer = $factory->create();

    $xml = \file_get_contents(__DIR__ . '/../../../../fixtures/IDN20400.xml');

    /** @var \BomWeather\Warning\Warning $warning */
    $warning = $serializer->deserialize($xml, Warning::class, 'xml');

    // Check issue time.
    $this->assertEquals('2026-04-21T00:00:00+00:00', $warning->getIssueTime()->format(\DATE_RFC3339));

    // Check warning info.
    $warningInfo = $warning->getWarningInfo();
    $this->assertNotNull($warningInfo);
    $this->assertEquals('Marine Wind Warning Summary for New South Wales', $warningInfo->getWarningTitle());
    $this->assertEquals('The next marine wind warning summary will be issued by 4:05 pm EST Tuesday.', $warningInfo->getWarningNextIssue());

    // Check regions.
    $regions = $warning->getRegions();
    $this->assertCount(1, $regions);

    $region = \array_shift($regions);
    $this->assertEquals('NSW_FA001', $region->getAac());
    $this->assertEquals('New South Wales', $region->getDescription());
    $this->assertEquals('region', $region->getType());
  }

}
