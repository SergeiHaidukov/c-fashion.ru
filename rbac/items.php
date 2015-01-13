<?php
return [
    'createPost' => [
        'type' => 2,
        'description' => 'Create a post',
    ],
    'crudCategories' => [
        'type' => 2,
        'description' => 'crud Categories',
    ],
    'crudProducts' => [
        'type' => 2,
        'description' => 'crud Products',
    ],
    'updatePost' => [
        'type' => 2,
        'description' => 'Update post',
    ],
    'dashboard' => [
        'type' => 2,
        'description' => 'Админ панель',
    ],
    'author' => [
        'type' => 1,
        'children' => [
            'createPost',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'crudCategories',
            'crudProducts',
            'dashboard',
            'updatePost',
            'author',
        ],
    ],
];
