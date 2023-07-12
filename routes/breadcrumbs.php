<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('login', function ($trail) {
    $trail->push(__(''), route('tasks.index'));
});

Breadcrumbs::for('register', function ($trail) {
    $trail->push(__(''), route('tasks.index'));
});

Breadcrumbs::for('password.request', function ($trail) {
    $trail->push(__(''), route('password.request'));
});

Breadcrumbs::for('tasks.index', function ($trail) {
    $trail->push(__('lang.my_tasks'), route('tasks.index'));
});

Breadcrumbs::for('tasks.create', function ($trail) {
    $trail->parent('tasks.index');
    $trail->push(__('lang.creation'), route('tasks.create'));
});

Breadcrumbs::for('tasks.edit', function ($trail, $task) {
    $trail->parent('tasks.index');
    $trail->push(__('lang.editing'), route('tasks.edit', $task));
});


