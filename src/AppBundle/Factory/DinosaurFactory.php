<?php
/**
 * Created by PhpStorm.
 * User: habib
 * Date: 7/28/2018
 * Time: 11:02 PM
 */

namespace AppBundle\Factory;


use AppBundle\Entity\Dinosaur;

class DinosaurFactory
{
   public function growVelociraptor(int $length):Dinosaur
   {
       return $this->createDinosaur('Velociraptor', true, $length);
   }

    private function createDinosaur(string $genus, bool $isCarnivorous, int $length)
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);
        $dinosaur->setLength($length);
        return $dinosaur;
    }
    public function growFromSpecification(string $specification)
    {
       // defaults
        $codeName="ING-".random_int(Dinosaur::LARGE,100);
        $length = $this->getLengthFromSpecification($specification);
        $isCarnivorous=false;


        if (stripos($specification, 'carnivorous') !== false) {
            $isCarnivorous = true;
        }


        $dinosaur=$this->createDinosaur($codeName,$isCarnivorous,$length);
        return $dinosaur;
    }

    private function getLengthFromSpecification(string $specification): int
    {
        $availableLengths = [
            'huge' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'omg' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'habib' => ['min' => Dinosaur::HUGE, 'max' => 100],
            'large' => ['min' => Dinosaur::LARGE, 'max' => Dinosaur::HUGE - 1],
        ];
        $minLength = 1;
        $maxLength = Dinosaur::LARGE - 1;

        foreach (explode(' ', $specification) as $keyword) {
            $keyword = strtolower($keyword);

            if (array_key_exists($keyword, $availableLengths)) {
                $minLength = $availableLengths[$keyword]['min'];
                $maxLength = $availableLengths[$keyword]['max'];

                break;
            }
        }

        return random_int($minLength, $maxLength);
    }

}