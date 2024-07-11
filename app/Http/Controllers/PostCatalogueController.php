<?php

namespace App\Http\Controllers;


use App\Models\PostCatalogue;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use PhpParser\Node\Stmt\Global_;

class PostCatalogueController extends Controller
{
    public function index()
    {
        $config=[
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"',
                asset('css/plugins/switchery/switchery.css')

            ],
            'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                asset('js/plugins/switchery/switchery.js'),
                asset('library/finder.js'),
             asset('plugins/ckfinder_2/ckfinder.js')
                ]];
            $title = 'Danh sách bài viết';

        $template = 'postCatalogue.index';
        return view('dashboard.index', compact('template','title','config'));
    }
    public function create(){
        $config=[
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"',
                asset('css/plugins/switchery/switchery.css')

            ],
            'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                asset('js/plugins/switchery/switchery.js'),
                asset('library/finder.js'),
               asset('plugins/ckfinder_2/ckfinder.js'),
                asset('plugins/ckeditor/ckeditor.js')
            ]];
        $title = 'Thêm mới bài viết';
        $template = 'postCatalogue.create';
        return view('dashboard.index', compact('template','title','config'));
    }
}
