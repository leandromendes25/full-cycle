<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation{
   public static function notNull(string $value,string $exceptMessage = null)
   {
    if (empty($value))#caso seja diferente de null
        throw new EntityValidationException($exceptMessage ?? 'Should not be empty');
    
   } 
   public static function strMaxLength($value,int $length = 255, string $exceptionMessage = null){
    if (strlen($value) >= $length)
        throw new EntityValidationException($exceptionMessage ?? "Should be lower than ${length}");
}
public static function strMinLength($value,int $length = 3, string $exceptionMessage = null){
    if (strlen($value) < $length)
        throw new EntityValidationException($exceptionMessage ?? "Should be higher than ${length}");

    }
    public static function strCanNullAndMaxLength($value = '',int $length = 255, string $exceptionMessage = null){
        if (!empty($value) && strlen($value) > $length)
            throw new EntityValidationException($exceptionMessage ?? "Should be empty or lower than ${length} characters");

        }
}