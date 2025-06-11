<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('menus')->insert([
            [
                "id" => 1,
                "name" => "Home",
                "icon" => "home",
                "slug" => "home",
                "order" => 0,
                "parent_id" => null,
                "is_active" => 1,
                "type" => "place",
                "deleted_at" => null,
                "created_at" => "2025-06-10 02:30:16",
                "updated_at" => "2025-06-10 02:30:16"
            ],
            [
                "id" => 3,
                "name" => "Article",
                "icon" => "newspaper",
                "slug" => "article",
                "order" => 2,
                "parent_id" => null,
                "is_active" => 1,
                "type" => "list",
                "deleted_at" => null,
                "created_at" => "2025-06-10 02:30:48",
                "updated_at" => "2025-06-10 02:30:48"
            ],
            [
                "id" => 2,
                "name" => "Profile",
                "icon" => "home_work",
                "slug" => "profile",
                "order" => 1,
                "parent_id" => null,
                "is_active" => 1,
                "type" => "page",
                "deleted_at" => null,
                "created_at" => "2025-06-10 02:40:27",
                "updated_at" => "2025-06-10 02:40:27"
            ],
            [
                "id" => 4,
                "name" => "RFC 2350",
                "icon" => "radar",
                "slug" => "rfc-2350",
                "order" => 3,
                "parent_id" => null,
                "is_active" => 1,
                "type" => "page",
                "deleted_at" => null,
                "created_at" => "2025-06-10 03:20:00",
                "updated_at" => "2025-06-10 03:20:00"
            ]
        ]);

        // categoris
        DB::table('categoris')->insert([
            "id" => 1,
            "name" => "informasi",
            "slug" => "informasi",
            "icon" => null,
            "description" => "informasi",
            "is_active" => 1,
            "parent_id" => null,
            "created_by" => 1,
            "deleted_at" => null,
            "created_at" => "2025-06-10 02:48:48",
            "updated_at" => "2025-06-10 02:48:48"
        ]);

        // posts
        DB::table('posts')->insert([
            "id" => 1,
            "menu_id" => 2,
            "title" => "berita 1",
            "sub_title" => "Article",
            "slug" => "berita-1",
            "content" => '[{"type":"heading","data":{"title":"test","level":"h1","uppercase":false}},{"type":"paragraph","data":{"content":"<p>informasiinformasiinformasiinformasi</p>"}}]',
            "image" => null,
            "published_at" => "2025-06-10",
            "is_active" => 1,
            "is_featured" => 1,
            "categori_id" => 1,
            "created_by" => 1,
            "deleted_at" => null,
            "created_at" => "2025-06-10 02:49:48",
            "updated_at" => "2025-06-10 02:49:48"
        ]);

        // setting_webs
        DB::table('setting_webs')->insert([
            [
                "id" => 2,
                "key" => "section-1",
                "value" => '[{"type":"desc","data":{"desc":"test"}},{"type":"view","data":{"section-view":"berita","model-view":"berita"}},{"type":"heading","data":{"content":"test","sub_content":"test"}}]',
                "status" => 1,
                "created_at" => "2025-06-10 02:40:54",
                "updated_at" => "2025-06-10 02:46:14"
            ],
            [
                "id" => 1,
                "key" => "hero-section",
                "value" => '[{"type":"desc","data":{"desc":"PADANG-CSIRT"}},{"type":"desc","data":{"desc":"PADANG-CSIRT merupakan tim yang berwenang untuk melakukan penanggulangan insiden, mitigasi insiden, investigasi dan analisis dampak insiden, serta pemulihan pasca insiden keamanan siber pada Pemerintah Kota Padang"}},{"type":"key","data":{"keys":"submit","content":"app/register"}},{"type":"key","data":{"keys":"faq","content":"faq"}}]',
                "status" => 1,
                "created_at" => "2025-06-10 02:56:52",
                "updated_at" => "2025-06-10 03:02:48"
            ]
        ]);

        // types
        DB::table('types')->insert([
            "id" => 1,
            "name" => "DDos",
            "description" => "DDos",
            "slug" => "ddos",
            "deleted_at" => null,
            "created_at" => "2025-06-10 02:31:32",
            "updated_at" => "2025-06-10 02:31:32"
        ]);

    }
}
