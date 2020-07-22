<?php
/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade laravel walter package to newer
 * versions in the future.
 *
 * @category    Walter
 * @package     Laravel
 * @author      Walter Nguyen
 * @copyright   Copyright (c) Walter Nguyen
 */
Breadcrumbs::register('admin.categories.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.categories.management'), route('admin.categories.index'));
});

Breadcrumbs::register('admin.categories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.categories.index');
    $breadcrumbs->push(trans('menus.backend.categories.create'), route('admin.categories.create'));
});

Breadcrumbs::register('admin.categories.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.categories.index');
    $breadcrumbs->push(trans('menus.backend.categories.edit'), route('admin.categories.edit', $id));
});
