<?php

namespace App\Tables;

use App\Models\Brickables\CarouselBrickSlide;
use App\View\Components\Admin\Media\Thumb;
use Illuminate\Database\Eloquent\Builder;
use Okipa\LaravelBrickables\Models\Brick;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class CarouselBrickSlidesTables extends AbstractTable
{
    protected Brick $carouselBrick;

    protected string $adminPanelUrl;

    public function __construct(Brick $carouselBrick, string $adminPanelUrl)
    {
        $this->carouselBrick = $carouselBrick;
        $this->adminPanelUrl = $adminPanelUrl;
    }

    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->identifier('carousel-brick-slides-table')
            ->model(CarouselBrickSlide::class)
            ->routes([
                'index' => [
                    'name' => 'brick.edit',
                    'params' => [$this->carouselBrick],
                ],
                'create' => [
                    'name' => 'brick.carousel.slide.create',
                    'params' => ['brick' => $this->carouselBrick, 'admin_panel_url' => $this->adminPanelUrl],
                ],
                'edit' => [
                    'name' => 'brick.carousel.slide.edit',
                    'params' => ['admin_panel_url' => $this->adminPanelUrl],
                ],
                'destroy' => ['name' => 'brick.carousel.slide.destroy'],
            ])
            ->query(function (Builder $query) {
                $query->where('brick_id', $this->carouselBrick->id);
                $query->ordered();
            })
            ->destroyConfirmationHtmlAttributes(function (CarouselBrickSlide $slide) {
                return [
                    'data-confirm' => __('crud.parent.destroy_confirm', [
                        'parent' => $this->carouselBrick->model->getReadableClassName() . ' > ' . __('Carousel'),
                        'entity' => __('Slides'),
                        'name' => $slide->label,
                    ]),
                ];
            })
            ->rowsNumber(null)
            ->activateRowsNumberDefinition(false);
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
        $table->column('id');
        $table->column('thumb')->html(fn(CarouselBrickSlide $slide) => app(Thumb::class)->render()->with([
            'media' => $slide->getFirstMedia('images'),
        ]));
        $table->column('label')->stringLimit(25)->value(fn(CarouselBrickSlide $slide) => $slide->label);
        $table->column('position')->html(fn(CarouselBrickSlide $slide) => '<span class="d-none id">'
            . $slide->id . '</span>'
            . '<span class="position">' . $slide->position . '</span>');
        $table->column('active')->html(fn(CarouselBrickSlide $slide) => view(
            'components.admin.table.bool',
            ['bool' => $slide->active]
        ));
        $table->column('created_at')->dateTimeFormat('d/m/Y H:i');
        $table->column('updated_at')->dateTimeFormat('d/m/Y H:i');
    }
}
