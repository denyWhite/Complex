<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 28.09.2020
 * Time: 15:59
 */

include __DIR__ . '/vendor/autoload.php';

$a = new Complex(-43432.539324, 5234.52343);
echo $a; echo '<br>';
$b = new Complex(239.04, -233.03);
echo Complex::conjugate($b); echo '<br>';
echo Complex::multiplication($a, $b); echo '<br>';
