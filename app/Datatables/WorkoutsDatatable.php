<?php

namespace App\Datatables;

use App\Models\Workout;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

use Str;

class WorkoutsDatatable extends Datatable
{
    public $slug = 'workouts';

    public function datasource()
    {
        return Workout::query();
    }

    public function setUp()
    {
        $this->buttons('filters', 'excel')
        ->pageLength(60)
        ->order('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::add('Заглавие')
                ->data('title', function ($workout) {
                    return Str::limit($workout->title, 30, '...');
                }),
            
            Column::add('Описание')
                ->data('description', function ($workout) {
                    return Str::limit($workout->description, 120, '...');
                }),

            Column::add('Продължителност')
                ->data('duration', function ($workout) {
                    return $workout->duration . ' минути';
                }),


            Column::add('Категория')
                ->data('category_id', function ($workout) {
                    return $workout->category->name;
                }),

            Column::add('Min калории')
                ->data('calories_min'),

            Column::add('Max калории')
                ->data('calories_max'),

            Column::add()
                ->width('20px')
                ->actions(function (Workout $workout) {
                    if(auth()->user()->ability('admin', 'workouts_crud')) {
                        return join([
                            Button::show('boilerplate.workouts.show', $workout),
                            Button::edit('boilerplate.workouts.edit', $workout),
                            Button::delete('boilerplate.workouts.destroy', $workout),
                        ]);
                    }
                    return join([
                        Button::show('boilerplate.workouts.show', $workout),
                    ]);
                }),
        ];
    }
}