<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class nameUnique implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $arr = User::select('name')->where('name', 'not like', Auth::user()->name)->get();
        $i = 0;
        $valueL = strtolower($value);
        foreach($arr as $a){
            $arrayL[$i] = strtolower($a->name);
            $i++;
        }
        $check = in_array($valueL, $arrayL);
        //dd($check);
        if($check == true){
           $fail('This name has been taken');
        }
    }
}
