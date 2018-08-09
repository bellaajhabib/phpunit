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
        $enclosure= new Enclosure();

        $enclosure->addDinosaur(new Dinosaur());
        $enclosure->addDinosaur(new Dinosaur());

        $this->assertCount(2,$enclosure->getDinosaurs());
    }
}