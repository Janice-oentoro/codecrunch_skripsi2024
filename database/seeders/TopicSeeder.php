<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics=[
            ['topic_name' => 'Python dictionary manipulation'],
            ['topic_name' => 'JavaScript promise chaining'],
            ['topic_name' => 'Java multithreading synchronization'],
            ['topic_name' => 'SQL joins and subqueries'],
            ['topic_name' => 'HTML5 canvas drawing techniques'],
            ['topic_name' => 'React component lifecycle methods'],
            ['topic_name' => 'PHP object-oriented programming concepts'],
            ['topic_name' => 'Git branching and merging strategies'],
            ['topic_name' => 'CSS grid layout implementation'],
            ['topic_name' => 'Node.js file system operations'],
            ['topic_name' => 'Angular dependency injection'],
            ['topic_name' => 'C++ pointer arithmetic'],
            ['topic_name' => 'Ruby on Rails form handling'],
            ['topic_name' => 'Swift error handling with try-catch'],
            ['topic_name' => 'Android app lifecycle management'],
            ['topic_name' => 'jQuery AJAX request handling'],
            ['topic_name' => 'Django authentication and authorization'],
            ['topic_name' => 'Python pandas data manipulation'],
            ['topic_name' => 'JavaScript event delegation'],
            ['topic_name' => 'Java Hibernate ORM configuration'],
            ['topic_name' => 'SQL indexing and optimization'],
            ['topic_name' => 'Bootstrap responsive design principles'],
            ['topic_name' => 'React Redux state management'],
            ['topic_name' => 'PHP error handling with try-catch'],
            ['topic_name' => 'Git rebase vs. merge'],
            ['topic_name' => 'CSS specificity and inheritance'],
            ['topic_name' => 'Node.js Express middleware usage'],
            ['topic_name' => 'Angular routing and navigation'],
            ['topic_name' => 'C++ memory management with smart pointers'],
            ['topic_name' => 'Ruby on Rails authentication implementation'],
            ['topic_name' => 'Swift Codable protocol for JSON parsing'],
            ['topic_name' => 'Android RecyclerView item animations'],
            ['topic_name' => 'jQuery DOM manipulation techniques'],
            ['topic_name' => 'Django form validation and handling'],
            ['topic_name' => 'Python virtual environments and package management'],
            ['topic_name' => 'JavaScript closure and lexical scope'],
            ['topic_name' => 'Java Spring framework configuration'],
            ['topic_name' => 'SQL transactions and isolation levels'],
            ['topic_name' => 'Bootstrap customization and theming'],
            ['topic_name' => 'React Hooks usage and best practices'],
            ['topic_name' => 'PHP sessions and cookies management'],
            ['topic_name' => 'Git stash and pop commands'],
            ['topic_name' => 'CSS animations and transitions'],
            ['topic_name' => 'Node.js REST API design and implementation'],
            ['topic_name' => 'Angular services and dependency injection'],
            ['topic_name' => 'C++ exception handling with try-catch'],
            ['topic_name' => 'Ruby on Rails CRUD operations with ActiveRecord'],
            ['topic_name' => 'Swift unit testing with XCTest'],
            ['topic_name' => 'Android permissions handling'],
            ['topic_name' => 'jQuery event propagation and bubbling'],
        ];
        foreach ($topics as $key => $value) {
            Topic::create($value);
        }
    }
}
