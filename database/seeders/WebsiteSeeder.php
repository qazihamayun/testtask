<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // data array for seeding
        $websites = [
            [
                'website_uuid' => Str::uuid()->toString(),
                'name' => 'TechCrunch',
                'url' => 'https://techcrunch.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'website_uuid' => Str::uuid()->toString(),
                'name' => 'The Verge',
                'url' => 'https://www.theverge.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'website_uuid' => Str::uuid()->toString(),
                'name' => 'Hacker News',
                'url' => 'https://news.ycombinator.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        // Insert the data into the database
        DB::table('websites')->insert($websites);
    }

}
