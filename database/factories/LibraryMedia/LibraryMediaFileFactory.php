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

    public function withCategory(LibraryMediaCategory $category = null): self
    {
        return $this->state(fn() => [
            'category_id' => $category->id ?? LibraryMediaCategory::inRandomOrder()->get()->first()->id,
        ]);
    }

    public function image(string $image = null): self
    {
        return $this->afterCreating(function (LibraryMediaFile $file) use ($image) {
            $image
                ? $file->addMedia($image)->preservingOriginal()->toMediaCollection('media')
                : $file->addMedia($this->faker->image())->toMediaCollection('media');
        });
    }

    public function pdf(string $pdf = null): self
    {
        return $this->afterCreating(function (LibraryMediaFile $file) use ($pdf) {
            $pdf
                ? $file->addMedia($pdf)->preservingOriginal()->toMediaCollection('media')
                : $file->addMedia(resource_path('dummy/file.pdf'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }

    public function video(string $video = null): self
    {
        return $this->afterCreating(function (LibraryMediaFile $file) use ($video) {
            $video
                ? $file->addMedia($video)->preservingOriginal()->toMediaCollection('media')
                : $file->addMedia(resource_path('dummy/video.mp4'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }

    public function audio(string $audio = null): self
    {
        return $this->afterCreating(function (LibraryMediaFile $file) use ($audio) {
            $audio
                ? $file->addMedia($audio)->preservingOriginal()->toMediaCollection('media')
                : $file->addMedia(resource_path('dummy/audio.mp3'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }

    public function doc(string $doc = null): self
    {
        return $this->afterCreating(function (LibraryMediaFile $file) use ($doc) {
            $doc
                ? $file->addMedia($doc)->preservingOriginal()->toMediaCollection('media')
                : $file->addMedia(resource_path('dummy/doc.odt'))
                ->preservingOriginal()
                ->toMediaCollection('media');
        });
    }
}
