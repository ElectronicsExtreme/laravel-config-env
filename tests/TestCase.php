<?php

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    public static function callMethod($object, $name, array $args)
    {
        $method = (new ReflectionClass($object))->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $args);
    }
}
