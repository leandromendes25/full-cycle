<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryCreateInputDto;
use Core\UseCase\DTO\Category\CategoryCreateOutPutDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

class CreateUseCaseCategoryUnitTest extends TestCase
{
    public function testCreateNewCategory()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $catName = 'Lanches';

        $this->mockEntity = Mockery::mock(Category::class, [
            $uuid, $catName]); #para ser retornado, ali necessário criar,
        $this->mockEntity->shouldReceive('id')->andReturn($uuid);

        $this->mockRepo = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class); #mock = dublê, do que queremos criar duble, criando uma class da interface
        #não passamos + obj por não estarmos tratando de obj unitario, criemos um mock
        $this->mockRepo->shouldReceive('insert')->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(CategoryCreateInputDto::class, [$uuid, $catName]);

        $useCase =  new CreateCategoryUseCase($this->mockRepo); #mock vai ficar apresentando erro, ignore e continue
        $responseUseCase = $useCase->execute($this->mockInputDto);
        $this->assertInstanceOf(CategoryCreateOutPutDto::class, $responseUseCase);
        Mockery::close();
    }
}
