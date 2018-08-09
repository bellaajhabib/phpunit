<?php
/**
 * Created by PhpStorm.
 * User: habib
 * Date: 8/6/2018
 * Time: 12:52 AM
 */

namespace Tests\AppBundle\Entity;


use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;
use AppBundle\Exception\DinosaursAreRunningRampantException;
use AppBundle\Exception\NotABuffetException;
use PHPUnit\Framework\TestCase;

class EnclosureTest extends TestCase
{

    public function testItHasNoDinaursByDefault()
    {
        $enclosure = new Enclosure();
        $this->assertEmpty(0,$enclosure->getDinosaurs());
    }

    public function testItAddsDinosaurs()

    {
        $enclosure= new Enclosure(true);

        $enclosure->addDinosaur(new Dinosaur());
        $enclosure->addDinosaur(new Dinosaur());

        $this->assertCount(2,$enclosure->getDinosaurs());
    }

    public function testItDoesNotAllowCarnivorousDinosToMixWithHerbivores()
    {
        $enclosure = new Enclosure(true);
        $enclosure->addDinosaur(new Dinosaur());
        $this->expectException(NotABuffetException::class);
        $enclosure->addDinosaur(new Dinosaur('Velociraptor', true));
    }
    /**
     * @expectedException  \AppBundle\Exception\NotABuffetException
     */
    public function testItDoesNotAllowToAddNonCarnivorousDinosaursToCarnivorousEnclosure()
    {
        $enclosure = new Enclosure(true);
       $enclosure->addDinosaur(new Dinosaur());

        $enclosure->addDinosaur(new Dinosaur('Velociraptor', true));
    }

    public function testItDoesNotAllowToAddDinosToUnsecureEnclosures()
    {
        $enclosure = new Enclosure();
        $this->expectException(DinosaursAreRunningRampantException::class);
        $this->expectExceptionMessage('Are you craaazy?!?');
        $enclosure->addDinosaur(new Dinosaur());
    }
}