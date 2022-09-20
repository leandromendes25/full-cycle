<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as UuidUuid;
use Throwable;

class CategoryUnitTest extends TestCase
{
    #Não usamos set pq não testamos isso com entidade, é só para testar
public function testAtributes()
{
$category = new Category(name: 'New Cat',description: 'This do not matter',isActive: true);
#podemos usar métodos mágicos para não precisar criar get/setter
$this->assertNotEmpty($category->id());
$this->assertEquals('New Cat', $category->name);
$this->assertEquals('This do not matter',$category->description);
$this->assertEquals(true,$category->isActive);
var_dump($category);
}
public function testActived()
{
$category = new Category(name:'The cat',description:'trolol',isActive: false);
$this->assertFalse($category->isActive);
$category->activate();
$this->assertTrue($category->isActive);
}

public function testDisabled(){
    $category = new Category(name:'The cat',description:'trolol');
    $this->assertTrue($category->isActive);
    $category->disable();
    $this->assertFalse($category->isActive);
}

public function testUpdate(){
    $uuid = (string) UuidUuid::uuid4()->toString();
    $category = new Category($uuid,'GUGU','de algum programa',true,'2022-01-01 12:12:12');
    $category->update('GUGU','de algum programa',true);#na propria catégoria verificamos se passou ou não
    $this->assertEquals('GUGU',$category->name);
    $this->assertEquals('de algum programa',$category->description);    
}

public function testExceptionName()
{
    try {
        $category = new Category(
            name:'Gs',
            description:'do'
        ); 
        
        $this->assertTrue(false);
    } catch (Throwable $th) {
        #valor esperado -> assertIstanceOf, e o th valor q eu tenho
        $this->assertInstanceOf(EntityValidationException::class,$th);
    }
}

public function testExceptionDescription()
{
    try {
        $category = new Category(
            name:'Randow name',
            description:random_bytes(99999)
        ); 
        
        $this->assertTrue(false);
    } catch (Throwable $th) {
        $this->assertInstanceOf(EntityValidationException::class,$th);
    }
}
}