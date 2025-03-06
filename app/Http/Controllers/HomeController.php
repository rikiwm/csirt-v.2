<?php

namespace App\Http\Controllers;

use App\Models\Categori;
use App\Models\Menu;
use App\Models\SettingWeb;
use App\Service\Post\PostFactories\PostFactory;
use Illuminate\Container\Attributes\Cache;
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

        $section = cache()->remember('section', 1, function() {
            return SettingWeb::query()->where('status', '1')->where('key','section-1')->first();
        });
        $s = cache()->remember('section2', 1, function() {
            return SettingWeb::query()->where('status', '1')->where('key','section-2')->first();
        });
        $s3 = cache()->remember('section3', 1, function() {
            return SettingWeb::query()->where('status', '1')->where('key','section-3')->first();
        });
        return view('home2',[
            'section'=> $section,
            'section2'=> $s,
            'section3'=> $s3,
        ]);
    }

    public function show($slug)
    {
        $menu = Menu::where('slug', $slug)->first();
        try {
            if (!$menu) {
                throw new \InvalidArgumentException('Menu not found');
            }

            if ($menu->type === 'place') {
                throw new \InvalidArgumentException('Unsupported menu type: '.$menu->type);
            }
            // if ($menu->type === 'link' && $menu->slug === 'faq') {
            //     $url = Str::replace(Request::url(),'', $menu->slug);
            //     return redirect()->route('faq');
            // }
            if ($menu->type === 'link') {
                $url = Str::replace(Request::url(),'', $menu->slug);
                return redirect('https://'.$url );
            }
            $postService = PostFactory::make($menu->type);
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }

        $cacheKey = 'post_'.$menu->type.'_'.$slug.'_'.$menu->id;
        $data = cache()->remember($cacheKey, 60, function() use ($postService, $menu, $slug) {
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
            ]
        );
    }

}
