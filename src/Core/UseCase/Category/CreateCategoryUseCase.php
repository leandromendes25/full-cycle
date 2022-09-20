<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\{CategoryCreateInputDto,CategoryCreateOutPutDto};

class CreateCategoryUseCase
{
protected $repository;#Passado -> repo, mas !$necessáriamente -> repo, por não ter Conheci -> camada inferior, usa -> inter
                      #No primeiro momento só passamos a classe mesmo para testes, não passamos nada da camada de infra 
public function __construct(CategoryRepositoryInterface $repo)
{
    $this->repository = $repo;
}
#Aqui passado dados nece -> cadastrar nova categoria  
public function execute(CategoryCreateInputDto $input): CategoryCreateOutPutDto
{ #com input criamos entidade, Id gerado auto
    $category = new Category(name: $input->name,description: $input->description, isActive: $input->isActive);
    $newCategory = $this->repository->insert($category);
    #retornando dados inseridos, ->metodoMagic
    return new CategoryCreateOutPutDto(id:$newCategory->id(),name:  $newCategory->name, isActive: $newCategory->isActive);
}
}