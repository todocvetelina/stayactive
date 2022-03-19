<?php

namespace App\Datatables;

use App\Models\Article;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

use Str;

class ArticlesDatatable extends Datatable
{
    public $slug = 'articles';

    public function datasource()
    {
        return Article::query();
    }

    public function setUp()
    {
        $this->order('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::add('Заглавие')
                ->data('title', function ($article ) {
                    return Str::limit($article->title, 60, '...');
                }),

            Column::add('Подзаглавие')
                ->data('subtitle', function ($article ) {
                    return Str::limit($article->subtitle, 60, '...');
                }),
            
                
            Column::add()
                ->width('20px')
                ->actions(function (Article $article) {
                    return join([
                        Button::show('articles.show', $article),
                        Button::edit('boilerplate.articles.edit', $article),
                        Button::delete('boilerplate.articles.destroy', $article),
                    ]);
                }),
        ];
    }
}