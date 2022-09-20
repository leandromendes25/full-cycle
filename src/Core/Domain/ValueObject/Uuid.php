<?php 

namespace Core\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as UuidUuid;

class Uuid
{
    public function __construct(
        protected string $value)
    {
        $this->ensureIsValid($value);
    }
    #retorna obj propria class, esse método vai criar o id, já validado
    public static function random(): self
    {   #versão4
        return new self(UuidUuid::uuid4()->toString());
    
    }
    #para retornar o id no construtor
    public function __toString(): string
    {
        return $this->value;
    }
    #ID não faria sentido, já que está validando ele inteiro, e com object value validamos o obj todo
    private function ensureIsValid(string $id){
        if(!UuidUuid::isValid($id)){
            throw new InvalidArgumentException(printf('<%s> does not allow the value <%s>.', static::class,$id));
        }
    }
}