<?php
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sitemap',function(){

    $sitemap=Sitemap::create('/')
        ->add(Url::create('/home'))
        ->add(Url::create('/about'))
        ->add(Url::create('/contact'));

    Post::all()->each(function(Post $post) use ($sitemap){

        $sitemap->add(Url::create('/post/{$post->slug}'));
    });

    $sitemap->writeToFile(public_path('sitemap.xml'));
});


