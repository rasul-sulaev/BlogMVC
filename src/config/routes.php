<?php

return [
    // MainController
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],
    'about' => [
        'controller' => 'main',
        'action' => 'about'
    ],
    'contacts' => [
        'controller' => 'main',
        'action' => 'contacts'
    ],
    'post/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'post'
    ],
    'category/{link:\w+}' => [
        'controller' => 'main',
        'action' => 'category'
    ],
    'search/query={query:\w+}' => [
        'controller' => 'main',
        'action' => 'search'
    ],



    // AdminController
    'admin' => [
        'controller' => 'admin',
        'action' => 'index',
    ],
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login'
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout'
    ],
    'admin/posts' => [
        'controller' => 'admin',
        'action' => 'posts'
    ],
    'admin/posts/add' => [
        'controller' => 'admin',
        'action' => 'postAdd'
    ],
    'admin/post/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'postEdit'
    ],
    'admin/post/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'postDelete'
    ],
    'admin/categories' => [
        'controller' => 'admin',
        'action' => 'categories'
    ],
    'admin/categories/add' => [
        'controller' => 'admin',
        'action' => 'categoryAdd'
    ],
    'admin/category/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'categoryEdit'
    ],
    'admin/category/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'categoryDelete'
    ],
    'admin/users' => [
        'controller' => 'admin',
        'action' => 'users'
    ],
    'admin/users/add' => [
        'controller' => 'admin',
        'action' => 'userAdd'
    ],
    'admin/user/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'userEdit'
    ],
    'admin/user/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'userDelete'
    ],
    'admin/comments' => [
        'controller' => 'admin',
        'action' => 'comments'
    ],
    'admin/comment/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'commentEdit'
    ],
    'admin/comment/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'commentDelete'
    ],





    // User
    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],
    'account/registration' => [
        'controller' => 'account',
        'action' => 'registration',
    ],
    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout',
    ],
];