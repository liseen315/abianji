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
                'value' => '世界让我遍体鳞伤|但伤口长出的却是翅膀',
                'type' => 'text',
                'create_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '网站关键词',
                'title' => 'keywords',
                'value' => 'PHP Laravel Blog',
                'type' => 'text',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '网站描述',
                'title' => 'description',
                'value' => 'Abianji Blog System',
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
                'name' => '启用slug',
                'title' => 'slug',
                'value' => '0',
                'type' => 'radio',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

        ]);
    }
}
