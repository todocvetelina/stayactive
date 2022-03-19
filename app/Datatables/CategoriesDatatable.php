<?php

namespace App\Datatables;

use App\Models\Category;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class CategoriesDatatable extends Datatable
{
    public $slug = 'categories';

    public function datasource()
    {
        return Category::query();
    }

    public function setUp()
    {
        $this->order('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::add('Име')
                ->data('name'),

            Column::add()
                ->actions(function (Category $category) {
                    return join([
                        Button::edit('boilerplate.categories.edit', $category),
                        Button::delete('boilerplate.categories.destroy', $category),
                    ]);
                }),
        ];
    }
}