<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ('production' === config('app.env') && \App\Page::all()->count() > 0) {
            return;
        }

        if ('production' !== config('app.env')) {
            DB::table('pages')->delete();
        }

        foreach ($this->items() as $item) {
            $page = \App\Page::create([
                'key' => $item['key'],
                'admin_title' => $item['title'],
                'active' => 1,
                'type' => $item['type'],
            ]);

            if (empty($item['elements'])) {
                continue;
            }

            foreach ($item['elements'] as $elementKey => $values) {
                foreach ($values as $key => $value) {
                    $data = [
                        'page_id' => $page->id,
                        'key' => $elementKey . '.' . $key,
                    ];

                    foreach (\localizer\locales() as $locale) {
                        $data[$locale->id()]['content'] = $value;
                    }

                    $pageElement = new \App\PageElement();
                    $pageElement->fill($data);
                    $pageElement->save();
                }
            }
        }
    }

    private function items()
    {
        return [
            ['key' => 'donation', 'title' => 'Donation', 'type' => 'page'],
            ['key' => 'faq', 'title' => 'FAQ', 'type' => 'page'],
            ['key' => 'privacy-policy', 'title' => 'Privacy Policy', 'type' => 'page'],
            ['key' => 'credits', 'title' => 'Credits', 'type' => 'page'],
            ['key' => 'terms-of-service', 'title' => 'Terms of Service', 'type' => 'page'],

            [
                'key' => 'welcome',
                'title' => 'Home page',
                'type' => 'page',
                'elements' => [
                    'hero' => [
                        'title' => 'Stand<br/>for green.',
                    ],
                    'about-us' => [
                        'name' => 'About Us',
                        'title' => 'Our reason for doing it.',
                        'description' => 'We chose to breathe freely and inspire thousands to do the same. One of our Paulownia trees produces oxygen enough for 10 people. We have to skyrocket that, Don’t delay, join us.',
                    ],
                    'how-it-works' => [
                        'name' => 'How It Work',
                        'what-we-do-title-first' => 'What we do.',
                        'what-we-do-description-first' => 'We unite passionate people, limit-pushers that believe in our cause. We gather, plant, give and loop it. Join the circle and breathe.',
                        'what-we-do-title-second' => 'What we do.',
                        'what-we-do-description-second' => 'You create a healthy home for everyone to live in. You define out future with every step you take. Do not hesitate and make it work.',
                        'you-can-help-title' => 'You can help us reforest the planet.',
                        'you-can-help-description' => 'This battle is a dance for many. We can\'t do it alone. Every contribution make a difference for generations to come. Will you join us?',
                    ],

                    'trees-planted' => [
                        'name' => 'Trees Planted',
                        'count' => '507,083',
                    ],
                ]
            ],
            [
                'key' => 'thank-you',
                'title' => 'Thank You',
                'type' => 'page',
                'elements' => [
                    'general' => [
                        'title' => 'Thank you.',
                        'description' => 'Your contribution reminds us of why we are doing it.',
                    ],
                ],
            ],

            [
                'key' => 'join-us',
                'title' => 'Join Us',
                'type' => 'widget',
                'elements' => [
                    'general' => [
                        'name' => 'Join Us',
                    ],
                    'difference' => [
                        'title' => 'You can make a difference.',
                        'description' => 'Spread the word about why trees are so important. They clean the air we breathe and the water we drink, stabilize our climate, protect biodiversity, and provide sustainable business for communities around the world.',
                    ],
                    'share' => [
                        'title' => 'Share our history.',
                        'description' => 'Share your story with us on social media, whether you\'re planting a tree in your yard, or just want to tell your friends how awesome trees are.',
                    ],
                ],
            ],
            [
                'key' => 'newsletter',
                'title' => 'Newsletter',
                'type' => 'widget',
                'elements' => [
                    'general' => [
                        'name' => 'Newsletter',
                        'title' => 'Keep up with our efforts.',
                    ],
                ],
            ],
        ];
    }
}
