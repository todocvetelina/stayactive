<?php

namespace App\Menu;

use Sebastienheyd\Boilerplate\Menu\Builder;

class Calculators
{
    public function make(Builder $menu)
    {
        $menu->add('Калкулатори', [
            'icon' => 'calculator',
            'order' => 99,
            
            'route' => 'boilerplate.calculator'
        ]);
    }
}
