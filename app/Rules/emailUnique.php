<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class emailUnique implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $arr = User::select('email')->where('name', 'not like', Auth::user()->name)->get();
        $i = 0;
        foreach($arr as $a){
            $array[$i] = $a->email;
            $i++;
        }
        $check = in_array($value, $array);

        //dd($check);
        if($check == true){
           $fail('This email has been taken');
        }
    }
}
