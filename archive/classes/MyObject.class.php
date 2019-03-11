<?php
/*
* Root class of all my classes
*/
class MyObject
{
    protected static function unsupportedMethod($method)
    {
        throw new Error('Unsupported method `'.$method.'` in class `'.get_called_class().'`.');
    }
}
