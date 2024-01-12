<?php

declare(strict_types = 1);

namespace BomWeather\Tests\Unit\Observation\Serializer;

use BomWeather\Observation\ObservationList;
use BomWeather\Observation\Serializer\ObservationSerializerFactory;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \BomWeather\Observation\Serializer\ObservationSerializerFactory
 */
class ObservationSerializerTest extends TestCase {

  /**
   * @covers ::create()
   */
  public function testDeserialize(): void {
    $serializer = ObservationSerializerFactory::create();
    $json = \file_get_contents(__DIR__ . '/../../../../fixtures/IDN60901.94759.json');

    /** @var \BomWeather\Observation\ObservationList $observationList */
    $observationList = $serializer->deserialize($json, ObservationList::class, 'json');

    $this->assertNotNull($observationList);

    $this->assertEquals("Issued at  9:31 am EST Monday 25 June 2018", $observationList->getRefreshMessage());

    $this->assertCount(144, $observationList->getObservations());

    $observation = $observationList->getLatest();

    $this->assertEquals('2018-06-25T09:30:00+10:00', $observation->getDateTime()->setTimezone(new \DateTimeZone('Australia/Sydney'))->format(DATE_RFC3339));
    $this->assertEquals(0, $observation->getRainSince9am());

    $pressure = $observation->getPressure();
    $this->assertNull($pressure->getMeanSeaLevel());
    $this->assertNull($pressure->getQnh());

    $temperature = $observation->getTemperature();
    $this->assertEquals(9.7, $temperature->getAirTemp());
    $this->assertEquals(7.8, $temperature->getApparentTemp());
    $this->assertEquals(1.1, $temperature->getDeltaT());
    $this->assertEquals(7.5, $temperature->getDewPoint());
    $this->assertEquals(86, $temperature->getRelativeHumidity());

    $wind = $observation->getWind();
    $this->assertEquals('W', $wind->getDirection());
    $this->assertEquals(7, $wind->getSpeedKmh());
    $this->assertEquals(4, $wind->getSpeedKnots());
    $this->assertEquals(11, $wind->getGustKmh());
    $this->assertEquals(6, $wind->getGustKnots());

    $station = $observation->getStation();
    $this->assertEquals('94759', $station->getId());
    $this->assertEquals('Terrey Hills', $station->getName());
    $this->assertEquals(-33.7, $station->getLatitude());
    $this->assertEquals(151.2, $station->getLongitude());
  }

}
