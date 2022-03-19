<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;

class Articles
{
    public function make(Builder $menu)
    {
        $item = $menu->add('Статии', [
            'icon' => 'newspaper',
            'permission' => 'articles_crud',
            'order' => 101,
        ]);

        $item->add('Всички статии', [
            'route' => 'boilerplate.articles.index'
        ]);

        $item->add('Създай статия', [
            'route' => 'boilerplate.articles.create'
        ]);
    }
}
