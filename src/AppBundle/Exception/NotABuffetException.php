<?php
/**
 * Created by PhpStorm.
 * User: habib
 * Date: 8/9/2018
 * Time: 9:12 AM
 */

namespace AppBundle\Exception;


class NotABuffetException extends \Exception
{
    protected $message = 'Please do not mix the carnivorous and non-carnivorous dinosaurs. It will be a massacre!';
}