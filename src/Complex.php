<?php
/**
 * Created by PhpStorm.
 * User: Denis Belov
 * Date: 28.09.2020
 * Time: 15:34
 */

class Complex
{
    /**
     * @var $realPart float Real part
     * @var $imaginaryPart float Imaginary part
     */
    private $realPart;
    private $imaginaryPart;

    /**
     * For compare
     */
    private const epsilon = 0.00001;

    /**
     * Complex constructor.
     * You can construct number with one, two or without arguments
     * Examples:
     * $number = new Complex() // Create 0
     * $number1 = new Complex(2) // Create 2
     * $number2 = new Complex(3, 4) // Create 3+4i
     * $number3 = new Complex(0, 5) // Create 5i
     * @param mixed ...$args
     */
    public function __construct(...$args)
    {
        $real = $args[0] ?? 0;
        if (! is_numeric($real)) {
            throw new InvalidArgumentException('Real part must be numeric');
        }
        $this->realPart = $real;
        $imaginary = $args[1] ?? 0;
        if (! is_numeric($imaginary)) {
            throw new InvalidArgumentException('Imaginary part must be numeric');
        }
        $this->imaginaryPart = $imaginary;
    }

    public function __toString()
    {
        return sprintf("%.3f+%.3fi", $this->getRealPart(), $this->getImaginaryPart());
    }

    /**
     * Complex conjugate
     * @param Complex $a
     * @return Complex
     */
    public static function conjugate(Complex $a): Complex
    {
        $b = clone $a;
        $b->imaginaryPart *= -1;
        return $b;
    }

    /**
     * Addition
     * @param Complex $a
     * @param Complex $b
     * @return Complex
     */
    public static function addition(Complex $a, Complex $b): Complex
    {
        $c = clone $a;
        $c->add($b);
        return $c;
    }

    /**
     * Subtraction
     * @param Complex $a
     * @param Complex $b
     * @return Complex
     */
    public static function subtraction(Complex $a, Complex $b): Complex
    {
        $c = clone $a;
        $c->sub($b);
        return $c;
    }

    /**
     * Multiplication
     * @param Complex $a
     * @param Complex $b
     * @return Complex
     */
    public static function multiplication(Complex $a, Complex $b): Complex
    {
        $c = clone $a;
        $c->mult($b);
        return $c;
    }

    /**
     * Division
     * @param Complex $a
     * @param Complex $b
     * @return Complex
     */
    public static function division(Complex $a, Complex $b): Complex
    {
        $c = clone $a;
        $c->div($b);
        return $c;
    }

    /**
     * Compare 2 complex
     * @param Complex $a
     * @param Complex $b
     * @return bool Is $a equal $b
     */
    public static function compare(Complex $a, Complex $b): bool
    {
        return abs($a->getRealPart() - $b->getRealPart()) < self::epsilon
            && abs($a->getImaginaryPart() - $b->getImaginaryPart()) < self::epsilon;
    }

    /**
     * Compare $complex with ($real + $imaginary i)
     * @param Complex $complex
     * @param float $real
     * @param float $imaginary
     * @return bool Is $complex equal ($real + $imaginary i)
     */
    public static function compareRI(Complex $complex, float $real, float $imaginary): bool
    {
        return self::compare($complex, new Complex($real, $imaginary));
    }

    /**
     * Get real part of number
     * @return float
     */
    public function getRealPart(): float
    {
        return $this->realPart;
    }

    /**
     * Get imaginary part of number
     * @return float
     */
    public function getImaginaryPart(): float
    {
        return $this->imaginaryPart;
    }

    /**
     * Add
     * @param Complex $a
     * @return void
     */
    public function add(Complex $a): void
    {
        $this->realPart += $a->getRealPart();
        $this->imaginaryPart += $a->getImaginaryPart();
    }

    /**
     * Subtract
     * @param Complex $a
     * @return void
     */
    public function sub(Complex $a): void
    {
        $this->realPart -= $a->getRealPart();
        $this->imaginaryPart -= $a->getImaginaryPart();
    }

    /**
     * Multiply
     * @param Complex $a
     * @return void
     */
    public function mult(Complex $a): void
    {
        $tempRealPart = $this->getRealPart();
        $this->realPart = $this->realPart * $a->getRealPart() - $this->imaginaryPart * $a->getImaginaryPart();
        $this->imaginaryPart = $this->imaginaryPart * $a->getRealPart() + $tempRealPart * $a->getImaginaryPart();
    }

    public function div(Complex $a): void
    {
        if (self::compareRI($a, 0, 0)) {
            throw new DivisionByZeroError("Division by zero");
        }
        $tempRealPath = $this->getRealPart();
        $denominator = $a->getRealPart() ** 2 + $a->getImaginaryPart() ** 2;
        $this->realPart = ($this->getRealPart() * $a->getRealPart() + $this->getImaginaryPart() * $a->getImaginaryPart())
            / $denominator;
        $this->imaginaryPart = ($this->getImaginaryPart() * $a->getRealPart() - $tempRealPath * $a->getImaginaryPart())
            / $denominator;
    }

}