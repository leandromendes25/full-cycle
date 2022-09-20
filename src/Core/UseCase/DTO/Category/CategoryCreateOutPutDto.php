<?php

namespace Core\UseCase\DTO\Category;

class CategoryCreateOutPutDto
{
    public function __construct(
    public string $id,
    public string $name,
    public string $description = '',
    public bool $isActive = true,)
    {
            
    }
    
}