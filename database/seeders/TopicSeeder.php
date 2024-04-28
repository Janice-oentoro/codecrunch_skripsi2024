<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            'name' => 'Python dictionary manipulation',
            'name' => 'JavaScript promise chaining',
            'name' => 'Java multithreading synchronization',
            'name' => 'SQL joins and subqueries',
            'name' => 'HTML5 canvas drawing techniques',
            'name' => 'React component lifecycle methods',
            'name' => 'PHP object-oriented programming concepts',
            'name' => 'Git branching and merging strategies',
            'name' => 'CSS grid layout implementation',
            'name' => 'Node.js file system operations',
            'name' => 'Angular dependency injection',
            'name' => 'C++ pointer arithmetic',
            'name' => 'Ruby on Rails form handling',
            'name' => 'Swift error handling with try-catch',
            'name' => 'Android app lifecycle management',
            'name' => 'jQuery AJAX request handling',
            'name' => 'Django authentication and authorization',
            'name' => 'Python pandas data manipulation',
            'name' => 'JavaScript event delegation',
            'name' => 'Java Hibernate ORM configuration',
            'name' => 'SQL indexing and optimization',
            'name' => 'Bootstrap responsive design principles',
            'name' => 'React Redux state management',
            'name' => 'PHP error handling with try-catch',
            'name' => 'Git rebase vs. merge',
            'name' => 'CSS specificity and inheritance',
            'name' => 'Node.js Express middleware usage',
            'name' => 'Angular routing and navigation',
            'name' => 'C++ memory management with smart pointers',
            'name' => 'Ruby on Rails authentication implementation',
            'name' => 'Swift Codable protocol for JSON parsing',
            'name' => 'Android RecyclerView item animations',
            'name' => 'jQuery DOM manipulation techniques',
            'name' => 'Django form validation and handling',
            'name' => 'Python virtual environments and package management',
            'name' => 'JavaScript closure and lexical scope',
            'name' => 'Java Spring framework configuration',
            'name' => 'SQL transactions and isolation levels',
            'name' => 'Bootstrap customization and theming',
            'name' => 'React Hooks usage and best practices',
            'name' => 'PHP sessions and cookies management',
            'name' => 'Git stash and pop commands',
            'name' => 'CSS animations and transitions',
            'name' => 'Node.js REST API design and implementation',
            'name' => 'Angular services and dependency injection',
            'name' => 'C++ exception handling with try-catch',
            'name' => 'Ruby on Rails CRUD operations with ActiveRecord',
            'name' => 'Swift unit testing with XCTest',
            'name' => 'Android permissions handling',
            'name' => 'jQuery event propagation and bubbling'

        ]);
    }
}
