<?php

class Validator extends MyObject
{
    public static function email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public static function phone($phone)
    {
        return preg_match("/^[0-9]{10}$/", $phone);
    }
    public static function entity($entity, $options = array())
    {
        $options = array_merge(array(
            'inDB' => true,
            'validate' => false,
            'type' => false,
        ), $options);
        $bool = true;
        if ($bool && $options['type']) {
            $bool = $enity instanceof $options['type'];
        }
        if ($bool && $options['inDB']) {
            $bool = $entity->isInDb();
        }
        if ($bool && $options['validate']) {
            $bool = $entity->isValid();
        }
        return $bool;
    }
    public static function string($string, $options = array())
    {
        $options = array_merge(array(
            'min' => false,
            'max' => false,
            'type' => true,
        ), $options);
        $bool = true;
        if ($bool && $options['type']) {
            $bool = is_string($string);
        }
        if ($bool && $options['min'] !== false) {
            $bool = strlen($string) >= $options['min'];
        }
        if ($bool && $options['max'] !== false) {
            $bool = strlen($string) <= $options['max'];
        }
        return $bool;
    }
    public static function range($number, $options = array())
    {
        $options = array_merge(array(
            'min' => false,
            'max' => false,
        ), $options);
        $bool = true;
        if ($bool && $options['min'] !== false) {
            $bool = $number >= $options['min'];
        }
        if ($bool && $options['max'] !== false) {
            $bool = $number <= $options['max'];
        }
        return $bool;
    }
    public static function date($string, $options = array())
    {
        $options = array_merge(array(
            'format' => 'Y-m-d H:i:s',
            'min' => false,
            'max' => false,
        ), $options);
        $datetime = DateTime::createFromFormat($options['format'], $string);
        $bool = true;
        if ($bool && $options['format']) {
            $bool = $datetime && $datetime->format($options['format']) == $string;
        }
        if ($bool && $options['min']) {
            $bool = $datetime && $datetime >= $options['min'];
        }
        if ($bool && $options['max']) {
            $bool = $datetime && $datetime <= $options['max'];
        }
        return $bool;
    }
}
