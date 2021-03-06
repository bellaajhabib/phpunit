<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dinosaurs")
 */
class Dinosaur
{
    /**
     * @ORM\Column(type="integer")
     */
    private $length = 0;

    /**
     * Dinosaur constructor.
     * @param int $length
     * @ORM\Column(type="string")
     */

    private $genus;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCarnivorous;

    const LARGE = 10;
    
    const HUGE=40;

    public function __construct(string $genus='Unknown',bool $isCarnivorous=false)
    {
        $this->genus=$genus;
        $this->isCarnivorous=$isCarnivorous;
    }

    public function getLength():int
    {
       return $this->length;
    }

    public function setLength (int $length)
    {
        $this->length=$length;
    }

    public function getSpecification():string
    {
        return sprintf(
            'The %s %s dinosaur is %d meters long',
            $this->genus,
            $this->isCarnivorous ? 'carnivorous' : 'non-carnivorous',
            $this->length
        );
    }

    public function getGenus():string
    {
        return $this->genus;
    }

    public function isCarnivorous(): bool
    {
        return $this->isCarnivorous;
    }
}
