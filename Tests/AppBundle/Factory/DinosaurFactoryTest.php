<?php
/**
 * Created by PhpStorm.
 * User: habib
 * Date: 7/27/2018
 * Time: 6:32 PM
 */

namespace Tests\AppBundle\Factory;


use AppBundle\Entity\Dinosaur;
use AppBundle\Factory\DinosaurFactory;
use PHPUnit\Framework\TestCase;



class DinosaurFactoryTest extends TestCase
{
    /**
     * @var DinasourFactory
     */
    private $factory;
    public function setUp()
    {
        $this->factory=new DinosaurFactory();
    }

    public function testItGrowsAVelociraptor()
    {

        $dinosaur=$this->factory->growVelociraptor(5);
        $this->assertInstanceOf(Dinosaur::class,$dinosaur);
        $this->assertInternalType('string',$dinosaur->getGenus());
        $this->assertSame('Velociraptor',$dinosaur->getGenus());
        $this->assertSame(5,$dinosaur->getLength());
    }

    public function testItGrowATriceratops()
    {
        $this->markTestIncomplete('watiting for confirmation from GenlLab');
    }
    public function testItGrowsABabyVelociraptor()
    {
       if(!class_exists('Nanny')){

           $this->markTestSkipped('There is nobody to watch the baby');

       }
        $dinosaur=$this->factory->growVelociraptor(1);
        $this->assertSame(1,$dinosaur->getLength());
    }

    /**
     * @dataProvider getSpecificationTests
     */
    public function testItGrowsADinosaurFromSpecification(string $spec,bool $expectedIsLarge,bool $expectedIsCarnivorous)
    {


        $dinosaur=$this->factory->growFromSpecification($spec);
        if ($expectedIsLarge) {
            $this->assertGreaterThanOrEqual(Dinosaur::LARGE, $dinosaur->getLength());
        }else {
            $this->assertLessThan(Dinosaur::LARGE, $dinosaur->getLength());
        }

        $this->assertSame($expectedIsCarnivorous, $dinosaur->isCarnivorous(),'Diets do not match');
    }


    public function getSpecificationTests()
    {

        return [
            // specification, is large, is carnivorous
            ['default response' => 'large carnivorous dinosaur', true, true],
            ['large ', true, false],
            
        ];
    }

    /**
     * @dataProvider getHugeDinosaurSpecTests
     */
    public function testGrowsAHugeDinosaur(string $specification)
    {
        $dinosaur= $this->factory->growFromSpecification($specification);

        $this->assertGreaterThanOrEqual(Dinosaur::HUGE,$dinosaur->getLength());
    }

    public function getHugeDinosaurSpecTests()
    {
        return [
            ['huge dinosaur'],
            ['huge dino'],
            ['huge'],
            ['OMG'],
            ['habib'],
        ];
    }
}