<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 28.09.2020
 * Time: 16:35
 */

use PHPUnit\Framework\TestCase;

final class ComplexTest extends TestCase
{

    public function testPrint(): void
    {
        $a = new Complex(-43432.539324, 5234.52343);
        $this->assertEquals($a, '-43432.539+5234.523i');
    }

    public function testCompareRI(): void
    {
        $a = new Complex(-4.2, 5.6);
        $this->assertTrue(Complex::compareRI($a, -4.2, 5.6));
    }

    public function testCompareRIfalse(): void
    {
        $a = new Complex(-4.2, 5.6);
        $this->assertFalse(Complex::compareRI($a, -4.2001, 5.6));
    }

    public function testCreateZero(): void
    {
        $a = new Complex();
        $this->assertTrue(Complex::compareRI($a, 0, 0));
    }

    public function testCreateReal(): void
    {
        $a = new Complex(1);
        $this->assertTrue(Complex::compareRI($a, 1, 0));
    }

    public function testCreateComplex(): void
    {
        $a = new Complex(1, 2);
        $this->assertTrue(Complex::compareRI($a, 1, 2));
    }

    public function testCompare(): void
    {
        $a = new Complex(4.2, 5.6);
        $this->assertTrue(Complex::compare($a, $a));
    }

    public function testCompareTrue(): void
    {
        $a = new Complex(4.2, 5.6);
        $b = new Complex(4.2, 5.6);
        $this->assertTrue(Complex::compare($a, $b));
    }

    public function testCompareFalse(): void
    {
        $a = new Complex(4.2, 5.5001);
        $b = new Complex(4.2, 5.5);
        $this->assertFalse(Complex::compare($a, $b));
    }

    public function testCompareFalse2(): void
    {
        $a = new Complex(4.1001, 5.6);
        $b = new Complex(4.1, 5.6);
        $this->assertFalse(Complex::compare($a, $b));
    }

    public function testCreateFloat(): void
    {
        $a = new Complex(2.3, 4.5);
        $this->assertTrue(Complex::compareRI($a, 2.3, 4.5));
    }

    public function testConjugate(): void {
        $a = new Complex(2.3, 4.5);
        $a = Complex::conjugate($a);
        $this->assertTrue(Complex::compareRI($a, 2.3, -4.5));
    }


    public function testAdd(): void
    {
        $a = new Complex(-4.5, 5.5);
        $b = new Complex(6.2, -3.4);
        $a->add($b);
        $this->assertTrue(Complex::compareRI($a, 1.7, 2.1));
    }

    public function testSumWithZero(): void
    {
        $a = new Complex(4.5, 5.5);
        $b = new Complex();
        $b->add($a);
        $this->assertTrue(Complex::compare($a, $b));
    }

    public function testAddition(): void
    {
        $a = new Complex(2, 4);
        $b = new Complex(5, 6);
        $c = Complex::addition($a, $b);
        $this->assertTrue(Complex::compareRI($c, 7, 10));
    }

    public function testAddition2(): void
    {
        $a = new Complex();
        $b = new Complex(-3, -6.1);
        $c = Complex::addition($a, $b);
        $this->assertTrue($c->getRealPart() === -3.0 && $c->getImaginaryPart() === -6.1);
    }

    public function testSubtract(): void
    {
        $a = new Complex(1, -4.50);
        $b = new Complex(0, 4.50);
        $a->sub($b);
        $this->assertTrue(Complex::compareRI($a, 1, -9));
    }

    public function testSubtraction(): void
    {
        $a = new Complex(2, 4.56);
        $b = new Complex(3, 4.56);
        $c = Complex::subtraction($a, $b);
        $this->assertTrue(Complex::compareRI($c, -1, 0));
    }

    public function testMultiply(): void
    {
        $a = new Complex(1, 4);
        $b = new Complex(2, 5);
        $a->mult($b);
        $this->assertTrue(Complex::compareRI($a, -18, 13));
    }

    public function testMultiplication(): void
    {
        $a = new Complex(1, 4.5);
        $b = new Complex(0, -4.5);
        $c = Complex::multiplication($a, $b);
        $this->assertTrue(Complex::compareRI($c, 20.25, -4.5));
    }

    public function testMultiplication2(): void
    {
        $a = new Complex(-2.5, -4.5);
        $b = new Complex(2.1, 4.5);
        $c = Complex::multiplication($a, $b);
        $this->assertTrue(Complex::compareRI($c, 15, -20.7));
    }

    public function testDivByZeroException(): void {

        $a = new Complex(1,1);
        $b = new Complex();
        $this->expectException(DivisionByZeroError::class);
        $a->div($b);
    }

    public function testDiv(): void {
        $a = new Complex(-2, -4);
        $b = new Complex(1, 3);
        $a->div($b);
        $this->assertTrue(Complex::compareRI($a, -1.4, 0.2));
    }

    public function testDivision(): void {
        $a = new Complex(2.5, 4);
        $b = new Complex(1.5, -2);
        $c = Complex::division($a, $b);
        $this->assertTrue(Complex::compareRI($c, -0.68, 1.76));
    }





}