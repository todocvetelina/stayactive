<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;

class Categories
{
    public function make(Builder $menu)
    {
        $item = $menu->add('Категории', [
            'icon' => 'network-wired',
            'order' => 100,
            'permission' => 'categories_crud',
        ]);

        $item->add('Всички категории', [
            'route' => 'boilerplate.categories.index'
        ]);

        $item->add('Създай категория', [
            'route' => 'boilerplate.categories.create'
        ]);
    }
}
