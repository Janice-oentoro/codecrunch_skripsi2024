<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;

class nameMatch implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $arr = User::select('name')->get();
        $i = 0;
        foreach($arr as $a){
            $array[$i] = $a->name;
            $i++;
        }

        $check = in_array($value, $array);

        //dd($array);
        if($check == false){
           $fail('User name must be an exact match.');
        }
    }
}
