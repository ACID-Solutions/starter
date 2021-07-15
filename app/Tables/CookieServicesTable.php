<?php

namespace App\Tables;

use App\Http\Requests\Cookies\CookieServicesIndexRequest;
use App\Models\Cookies\CookieCategory;
use App\Models\Cookies\CookieService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class CookieServicesTable extends AbstractTable
{
    public function __construct(protected CookieServicesIndexRequest $request)
    {
        //
    }

    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(CookieService::class)
            ->routes([
                'index' => ['name' => 'cookie.services.index'],
                'create' => ['name' => 'cookie.service.create'],
                'edit' => ['name' => 'cookie.service.edit'],
                'destroy' => ['name' => 'cookie.service.destroy'],
            ])
            ->query(function (Builder $query) {
                $query->with(['categories']);
                if ($this->request->has('category_id')) {
                    $query->whereHas(
                        'categories',
                        fn(Builder $categories) => $categories->where('id', $this->request->category_id)
                    );
                }
            })
            ->destroyConfirmationHtmlAttributes(fn(CookieService $cookieService) => [
                'data-confirm' => __('crud.parent.destroy_confirm', [
                    'parent' => __('Cookies'),
                    'entity' => __('Services'),
                    'name' => $cookieService->title,
                ]),
            ]);
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
        $table->column('unique_key')->sortable()->searchable();
        $table->column('title')->stringLimit(25)->sortable()->searchable();
        $table->column()
            ->title(__('Categories'))
            ->value(fn(CookieService $cookieService) => $cookieService->categories
                ->map(function (CookieCategory $cookieCategory) {
                    $cookieCategory->title = Str::limit($cookieCategory->title, 25);

                    return $cookieCategory;
                })
                ->implode('title', ', '));
        $table->column('active')
            ->sortable()
            ->html(fn(CookieService $cookieService) => view(
                'components.admin.table.bool',
                ['bool' => $cookieService->active]
            ));
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i')->sortable();
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i')->sortable(true, 'desc');
    }
}
