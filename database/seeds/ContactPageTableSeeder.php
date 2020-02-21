<?php

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Pages\TitleDescriptionPageContent;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ContactPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $fakerFr = Factory::create('fr_EN');
        $fakerEn = Factory::create('en_GB');
        /** @var \App\Models\Pages\TitleDescriptionPageContent $pageContent */
        $pageContent = (new TitleDescriptionPageContent)->create(['slug' => 'contact-page-content']);
        $pageContent->saveSeoMeta([
            'meta_title' => ['fr' => 'Nous contacter', 'en' => 'Contact us'],
            'meta_description' => ['fr' => $fakerFr->text(150), 'en' => $fakerEn->text(150)],
        ]);
        $pageContent->addBrick(TitleH1::class, ['title' => ['fr' => 'Nous contacter', 'en' => 'Contact us']]);
        $pageContent->addBrick(OneTextColumn::class, [
            'text' => [
                'fr' => 'Pour toute question, n\'hésitez pas à prendre contact avec notre équipe. '
                    . 'Nous vous recontacterons dans les plus brefs délais.',
                'en' => 'If you have any questions, please contact our team. We will get back to you as soon as '
                    . 'possible.',
            ],
        ]);
    }
}
