<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Programming;

class ProgrammingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programmings = [
            ['prog_name' => 'Python'],
            ['prog_name' => 'Java'],
            ['prog_name' => 'JavaScript'],
            ['prog_name' => 'C++'],
            ['prog_name' => 'Ruby'],
            ['prog_name' => 'Swift'],
            ['prog_name' => 'C#'],
            ['prog_name' => 'PHP'],
            ['prog_name' => 'Go'],
            ['prog_name' => 'Rust'],
            ['prog_name' => 'Kotlin'],
            ['prog_name' => 'TypeScript'],
            ['prog_name' => 'Scala'],
            ['prog_name' => 'Haskell'],
            ['prog_name' => 'Perl'],
            ['prog_name' => 'Lua'],
            ['prog_name' => 'Dart'],
            ['prog_name' => 'Objective-C'],
            ['prog_name' => 'Assembly'],
            ['prog_name' => 'SQL'],
            ['prog_name' => 'Clojure'],
            ['prog_name' => 'Erlang'],
            ['prog_name' => 'Groovy'],
            ['prog_name' => 'R'],
            ['prog_name' => 'F#'],
            ['prog_name' => 'Scheme'],
            ['prog_name' => 'Smalltalk'],
            ['prog_name' => 'Bash'],
            ['prog_name' => 'PL/SQL'],
            ['prog_name' => 'Fortran'],
            ['prog_name' => 'Ada'],
            ['prog_name' => 'Prolog'],
            ['prog_name' => 'Lisp'],
            ['prog_name' => 'COBOL'],
            ['prog_name' => 'MATLAB'],
            ['prog_name' => 'Delphi'],
            ['prog_name' => 'Objective-C'],
            ['prog_name' => 'ActionScript'],
            ['prog_name' => 'Visual Basic'],
            ['prog_name' => 'VBScript'],
            ['prog_name' => 'Elixir'],
            ['prog_name' => 'Julia'],
            ['prog_name' => 'OCaml'],
            ['prog_name' => 'Django'],
            ['prog_name' => 'AngularJS'],
            ['prog_name' => 'React'],
            ['prog_name' => 'Vue.js'],
            ['prog_name' => 'Ember.js'],
            ['prog_name' => 'Backbone.js'],
            ['prog_name' => 'Meteor.js'],
            ['prog_name' => 'Express.js'],
            ['prog_name' => 'Flask'],
            ['prog_name' => 'Spring'],
            ['prog_name' => 'Hibernate'],
            ['prog_name' => 'Laravel'],
            ['prog_name' => 'Symfony'],
            ['prog_name' => 'CodeIgniter'],
            ['prog_name' => 'CakePHP'],
            ['prog_name' => 'Zend Framework'],
            ['prog_name' => 'ASP.NET'],
            ['prog_name' => 'Node.js'],
            ['prog_name' => 'Ruby on Rails'],
            ['prog_name' => 'Django'],
            ['prog_name' => 'Flask'],
            ['prog_name' => 'Pyramid'],
            ['prog_name' => 'CherryPy'],
            ['prog_name' => 'TurboGears'],
            ['prog_name' => 'Plone'],
            ['prog_name' => 'Django CMS'],
            ['prog_name' => 'WordPress'],
            ['prog_name' => 'Joomla'],
            ['prog_name' => 'Drupal'],
            ['prog_name' => 'Magento'],
            ['prog_name' => 'Shopify'],
            ['prog_name' => 'OpenCart'],
            ['prog_name' => 'PrestaShop'],
            ['prog_name' => 'BigCommerce'],
            ['prog_name' => 'WooCommerce'],
            ['prog_name' => 'osCommerce'],
            ['prog_name' => 'Zen Cart'],
            ['prog_name' => 'Spree Commerce'],
            ['prog_name' => 'Symfony'],
            ['prog_name' => 'Laravel'],
            ['prog_name' => 'CodeIgniter'],
            ['prog_name' => 'Zend Framework'],
            ['prog_name' => 'CakePHP'],
            ['prog_name' => 'Yii'],
            ['prog_name' => 'Phalcon'],
            ['prog_name' => 'FuelPHP'],
            ['prog_name' => 'Slim'],
            ['prog_name' => 'Lumen'],
            ['prog_name' => 'Silex'],
            ['prog_name' => 'F3'],
            ['prog_name' => 'Pop PHP'],
            ['prog_name' => 'Aura']
        ];

        foreach ($programmings as $key => $value) {
            Programming::create($value);
        }
    }
}
