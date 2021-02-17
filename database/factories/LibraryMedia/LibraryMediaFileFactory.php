<?php

namespace Database\Factories\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaCategory;
use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LibraryMediaFileFactory extends Factory
{
    /** @var string */
    protected $model = LibraryMediaFile::class;

    public function definition(): array
    {
        return [
            'name' => [
                'fr' => Str::title($this->faker->word),
                'en' => Str::title($this->faker->word),
            ],
        ];
    }

    public function image(): Factory
    {
        return $this->afterCreating(function (LibraryMediaFile $file) {
            $file->addMedia($this->faker->image(null, 640, 480, null, true, true, 'Media'))
                ->toMediaCollection('media');
        });
    }

    public function pdf(): Factory
    {
        return $this->afterCreating(function (LibraryMediaFile $file) {
            $file->addMedia(resource_path('dummy/file.pdf'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }

    public function video(): Factory
    {
        return $this->afterCreating(function (LibraryMediaFile $file) {
            $file->addMedia(resource_path('dummy/video.mp4'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }

    public function audio(): Factory
    {
        return $this->afterCreating(function (LibraryMediaFile $file) {
            $file->addMedia(resource_path('dummy/audio.mp3'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }

    public function doc(): Factory
    {
        return $this->afterCreating(function (LibraryMediaFile $file) {
            $file->addMedia(resource_path('dummy/doc.odt'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }

    public function withCategory(): Factory
    {
        return $this->afterMaking(function (LibraryMediaFile $file) {
            $categories = LibraryMediaCategory::get();
            $file->category_id = $categories->random(1)->first()->id;
        });
    }
}
