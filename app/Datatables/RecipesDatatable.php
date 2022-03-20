<?php

namespace App\Datatables;

use App\Models\Recipe;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;
use Str;

class RecipesDatatable extends Datatable
{
    public $slug = 'recipes';

    public function datasource()
    {
        return Recipe::query();
    }

    public function setUp()
    {
        $this->order('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::add('Заглавие')
                ->data('title', function ($recipe) {
                    return Str::limit($recipe->title, 60, '...');
                }),

            Column::add('Описание')
                ->data('description', function ($recipe) {
                    return Str::limit($recipe->description, 120, '...');
                }),

            Column::add('Време за подготовка')
                ->data('prep_time', function ($recipe) {
                    return $recipe->prep_time . ' минути';
                }),

            Column::add('Време за готвене')
                ->data('cook_time', function ($recipe) {
                    return $recipe->cook_time . ' минути';
                }),

            Column::add('Порции')
                ->data('servings'),

            Column::add()
                ->width('20px')
                ->actions(function (Recipe $recipe) {
                    if(auth()->user()->ability('admin', 'recipes_crud')) {
                        return join([
                            Button::edit('boilerplate.recipes.edit', $recipe),
                            Button::show('boilerplate.recipes.show', $recipe),
                            Button::delete('boilerplate.recipes.destroy', $recipe),
                        ]);
                    }

                    return join([
                        Button::show('boilerplate.recipes.show', $recipe),
                    ]);
                    
                }),
        ];
    }
}
