<?php

namespace Test\Unit;

use Core\Teste;
use PHPUnit\Framework\TestCase;

class TesteUnitTest extends TestCase
{
    public function testCallMethodFoo()
    {
        $teste = new Teste();
        $response = $teste->foo();
        $this->assertEquals('123', $response);
    }
}