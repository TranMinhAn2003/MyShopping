<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use PhpParser\Node\Stmt\Global_;

class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    protected $userRepository;

    public function __construct(UserService $userService, ProvinceRepository $provinceRepository, UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $user = $this->userService->paginate($request);
       $config=[
           'css' => [
               'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"',
               asset('css/plugins/switchery/switchery.css')

           ],
           'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
               asset('js/plugins/switchery/switchery.js'),

           ]];
        $config['setup'] = config('setup.user');
        if (array_key_exists('index', $config['setup'])) {
            $updateConfig = $config['setup']['index'];
            $title = $updateConfig['title'];
        } else {
            $title = 'Danh sách thành viên';
        }
        $template = 'user.index';
        return view('dashboard.index', compact('template', 'config', 'title', 'user'));
    }


    private function config()
    {
        return [
            'js' => [
                asset('js/plugins/switchery/switchery.js')],
            'css' => [
                asset('css/plugins/switchery/switchery.css')]
        ];

    }

    public function create()
    {
        $template = 'user.create';
        $province = $this->provinceRepository->all();
        $config = [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"'
            ],
            'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',


            ]];
        $config['setup'] = config('setup.user');
        if (array_key_exists('create', $config['setup'])) {
            $updateConfig = $config['setup']['create'];
            $title = $updateConfig['title'];
        } else {
            $title = 'Thêm mới thành viên';
        }

        return view('dashboard.index', compact('template', 'config', 'title', 'province'));
    }

    public function store(UserStoreRequest $request)
    {
        if ($this->userService->create($request)) {
            flash()->success('Thêm mới bản ghi thành công ');
            return redirect()->route('user.index');
        } else {
            flash()->error('Thêm mới bản ghi không thành công');
            return redirect()->route('user.create');
        }
    }

    public function edit($id)
    {
        $users = $this->userRepository->findById($id);

        $template = 'user.update';
        $province = $this->provinceRepository->all();
        $config = [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"'
            ],
            'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',


            ]];

        $config['setup'] = config('setup.user');
        if (array_key_exists('update', $config['setup'])) {
            $updateConfig = $config['setup']['update'];
            $title = $updateConfig['title'];
        } else {
            $title = 'Cập nhật thành viên';
        }

        return view('dashboard.index', compact('template', 'config', 'title', 'province', 'users'));

    }

    public function update($id, UserUpdateRequest $request)
    {
        if ($this->userService->update($id, $request)) {
            flash()->success('Cập nhật bản ghi thành công ');
            return redirect()->route('user.index');
        } else {
            flash()->error('Cập nhật  bản ghi không thành công');
            return redirect()->route('user.create');
        }
    }

    public function destroy($id)
    {
        if ($this->userService->destroy($id)) {
            flash()->success('Xóa bản ghi thành công ');
            return redirect()->route('user.index');
        } else {
            flash()->error('Xóa bản ghi không thành công');
            return redirect()->route('user.index');
        }
    }

    public function delete($id)
    {
        $users = $this->userRepository->findById($id);

        $template = 'user.delete';
        $province = $this->provinceRepository->all();
        $config = [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"'
            ],
            'js' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',

            ]];

        $config['setup'] = config('setup.user');
        if (array_key_exists('delete', $config['setup'])) {
            $updateConfig = $config['setup']['delete'];
            $title = $updateConfig['title'];
        } else {
            $title = 'Xóa thành viên';
        }
        return view('dashboard.index', compact('template', 'config', 'title', 'users','province'));

    }
}
