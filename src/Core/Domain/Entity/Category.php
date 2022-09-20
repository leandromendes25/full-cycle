<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicTrait;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Category
{
    use MethodsMagicTrait;
    
    public function __construct(
        protected Uuid|string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
        protected DateTime|string $createdAt = '')
    {
        $this->validate();
        $this->id = $this->id ? new Uuid($this->id) : Uuid::random();#só para permitir testar o tdd
        #new DateTime($this->createdAt) converter o q vem como string do banco para tipo date
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime();#new dateTime cria now automatico 
    }
    public function activate(){
        $this->isActive = true;
    }
    public function disable(){
        $this->isActive = false;
    }
    public function update(string $name,string $description = '')
    {
        $this->name = $name;
        $this->description = $description;
        $this->validate();
    }
#validar categoria
public function validate()
{
    DomainValidation::notNull($this->name);
    DomainValidation::strMaxLength($this->name);
    DomainValidation::strMinLength($this->name);
    DomainValidation::strCanNullAndMaxLength($this->description);
    
}
}