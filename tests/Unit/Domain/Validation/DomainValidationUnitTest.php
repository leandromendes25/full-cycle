<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;
use Throwable;

class DomainValidationUnitTest extends TestCase
{
    public function testNotNull(){
        try {
            $value = '';
            DomainValidation::notNull($value);
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class,$th);
        }
    }
    public function testNotNullCustomMessageException(){
        try {
            $value = '';
            DomainValidation::notNull($value,'custom message here');
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class,$th);
        }
    }
    public function testStrMaxLengh(){
        try {
            $value = 'Teste';
            DomainValidation::strMaxLength($value,5,'characteres maximo atingido');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class,$th,'characteres maximo atingido');
        }
    }
    public function testStrMinLength(){
        try {
            $value = 'Te';
            DomainValidation::strMinLength($value,3,'characteres minimo não atingido');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class,$th,'characteres minimo não atingido');
        }
    }
    public function testStrCanNullAndMaxLength(){
        try {
            $value = 'ssss';
            DomainValidation::strCanNullAndMaxLength($value,3,'Valor deve ser nulo ou menor');
            $this->assertTrue(false);
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class,$th);
        }
    }
}