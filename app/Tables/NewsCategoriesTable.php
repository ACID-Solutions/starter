<?php

namespace App\Tables;

use App\Models\News\NewsCategory;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class NewsCategoriesTable extends AbstractTable
{
    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(NewsCategory::class)
            ->routes([
                'index' => ['name' => 'news.categories.index'],
                'create' => ['name' => 'news.category.create'],
                'edit' => ['name' => 'news.category.edit'],
                'destroy' => ['name' => 'news.category.destroy'],
            ])
            ->destroyConfirmationHtmlAttributes(function (NewsCategory $category) {
                return [
                    'data-confirm' => __('crud.parent.destroy_confirm', [
                        'parent' => __('News'),
                        'entity' => __('Categories'),
                        'name' => $category->title,
                    ]),
                ];
            });
    }

    /**
     * Configure the table columns.
     *
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('id')->sortable();
        $table->column('title')->stringLimit(25)->sortable()->searchable();
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true);
    }
}
