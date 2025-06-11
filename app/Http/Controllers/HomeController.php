<?php

namespace App\Http\Controllers;

use App\Models\Categori;
use App\Models\Menu;
use App\Models\SettingWeb;
use App\Service\Post\PostFactories\PostFactory;
use Faker\Provider\Lorem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    private PostFactory $postFactory;

    /**
     * Konstruktor dengan Dependency Injection.
     *
     * @param  PostInterface  $postInterface
     */
    public function __construct(PostFactory $postFactory)
    {
        $this->postFactory = $postFactory;
    }
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

        $section = Cache::remember('section', 3260, function() {
            return SettingWeb::query()->where('status', '1')->where('key','section-1')->first();
        });
        $section2 =  Cache::remember('section2', 3260, function() {
            return SettingWeb::query()->where('status', '1')->where('key','section-2')->first();
        });
        $section3 =  Cache::remember('section3', 3260, function() {
            return SettingWeb::query()->where('status', '1')->where('key','section-3')->first();
        });
        return view('home2',[
            'section'=> $section,
            'section2'=> $section2,
            'section3'=> $section3,
        ]);
    }

    public function show($slug)
    {
        $menu = Menu::where('slug', $slug)->first();
        try {
              if (!$menu || $menu->type === 'place') {
                return redirect()->route('home')->with('error', 'Menu tidak ditemukan atau tidak didukung.');
            }

            if ($menu->type === 'place') {
                throw new \InvalidArgumentException('Unsupported menu type: '.$menu->type);
            }

             if ($menu->type === 'link') {
                return redirect()->away($menu->slug);
            }
            $postService = PostFactory::make($menu->type);
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }

            try {
                $cacheKey = 'post_'.$menu->type.'_'.$slug.'_'.$menu->id;
            $data = Cache::remember($cacheKey, 1260, function() use ($postService, $menu, $slug) {
                return $postService->show($menu->type, $slug, $menu->id);
            });

            $category = Categori::query()->where('id', $data['data']['categori_id'] ?? null )->select('name','description')->first();
            if (!$category) {
                $category = Categori::query()->select('name','description')->get();
            }
            return view($data['view'],
                [
                    'category' => $category ?? null,
                    'title' => $data['title'],
                    'data' => $data['data'],
                    'top' => $data['top'] ?? null,
                ]
            );
            } catch (\Exception $e) {
                return abort(420, $e->getMessage());
            }

    }

}
