<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;

class Recipes
{
    public function make(Builder $menu)
    {
        $item = $menu->add('Reцепти', [
            'icon' => 'cookie',
            'order' => 100,
        ]);

        $item->add('Всички рецепти', [
            'route' => 'boilerplate.recipes.index'
        ]);

        $item->add('Създай рецепта', [
            'route' => 'boilerplate.recipes.create',
            'permission' => 'recipes_crud'
        ]);
    }
}
