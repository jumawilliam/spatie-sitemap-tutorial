<?php
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/sitemap',function(){
    $sitemap=Sitemap::create()
        ->add(Url::create('/home'))
        ->add(Url::create('/about'))
        ->add(Url::create('/contact'));

        Post::all()->each(function(Post $post) use ($sitemap){
            $sitemap->add(Url::create("/posts/{$post->slug}"));
        });

        $sitemap->writeTofile(public_path('sitemap.xml'));

        return 'Sitemap Created Succesfully';
});