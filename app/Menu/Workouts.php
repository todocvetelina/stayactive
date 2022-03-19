<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;

class Workouts
{
    public function make(Builder $menu)
    {
        $item = $menu->add('Тренировки', [
            'icon' => 'video',
            'order' => 99,
        ]);

        $item->add('Всички тренировки ', [
            'route' => 'boilerplate.workouts.index'
        ]);

        $item->add('Създай тренировка', [
            'route' => 'boilerplate.workouts.create',
            // 'permission' => 'workouts_crud'
        ]);
    }
}
