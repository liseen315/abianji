<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('configs')->truncate();

        DB::table('configs')->insert([
            [
                'name' => '网站名称',
                'title' => 'site_name',
                'value' => '阿比安吉',
                'type' => 'text',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '网站子标题',
                'title' => 'sub_title',
                'value' => '争取做一个有故事的人',
                'type' => 'text',
                'create_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '网站关键词',
                'title' => 'keywords',
                'value' => 'PHP Laravel Blog 阿比安吉',
                'type' => 'text',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '网站描述',
                'title' => 'description',
                'value' => 'Abianji is a blog system by Laravel',
                'type' => 'text',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '统计代码',
                'title' => 'analysis',
                'value' => NULL,
                'type' => 'textarea',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '备案号',
                'title' => 'ipc',
                'value' => '© ' . Carbon::now()->year . ' Abianji.com',
                'type' => 'text',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '封面水印',
                'title' => 'water',
                'value' => 'Abianji',
                'type' => 'text',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '是否启用Slug',
                'title' => 'slug',
                'value' => '1',
                'type' => 'radio',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

        ]);
    }
}
