<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;





/**
 * Class UserService
 * @package App\Services
 */
class UserService  implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function paginate($request)
    {
        $condition['keyword']=addslashes($request->input('keyword'));
        $condition['user_agent'] = $request->input('user_agent');

        if ($condition['user_agent'] !== null) {
            switch ($condition['user_agent']) {
                case '1':
                    $condition['user_agent'] = 'Quản trị viên';
                    break;
                case '2':
                    $condition['user_agent'] = 'Cộng tác viên';
                    break;
                default:
                    $condition['user_agent'] = null;
                    break;
            }
        }
        $user = $this->userRepository->pagintion(['*'],$condition,[],['path'=>'user/index']);
        return $user;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $load = $request->except(['_token', 're_password']);
            //  $loadbrithday=Carbon::createFromFormat('d/m/Y',$load['birthday']);
            //  $load['birthday']=$loadbrithday->format('Y-m-d');
            $load['password'] = Hash:: make($load['password']);
            if (isset($load['gender'])) {
                switch ($load['gender']) {
                    case '1':
                        $load['gender'] = 'Nam';
                        break;
                    case '2':
                        $load['gender'] = 'Nữ';
                        break;

                }
            }
            if (isset($load['user_agent'])) {
                switch ($load['user_agent']) {
                    case '1':
                        $load['user_agent'] = 'Quản trị viên';
                        break;
                    case '2':
                        $load['user_agent'] = 'Cộng tác viên';
                        break;
                }
            }
            $user = $this->userRepository->create($load);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id,$request)
    {
        DB::beginTransaction();
        try {

            $load = $request->except(['_token']);
            //  $loadbrithday=Carbon::createFromFormat('d/m/Y',$load['birthday']);
            //  $load['birthday']=$loadbrithday->format('Y-m-d');

            if (isset($load['gender'])) {
                switch ($load['gender']) {
                    case '1':
                        $load['gender'] = 'Nam';
                        break;
                    case '2':
                        $load['gender'] = 'Nữ';
                        break;

                }
            }
            if (isset($load['user_agent'])) {
                switch ($load['user_agent']) {
                    case '1':
                        $load['user_agent'] = 'Quản trị viên';
                        break;
                    case '2':
                        $load['user_agent'] = 'Cộng tác viên';
                        break;
                }
            }
            $user = $this->userRepository->update($id,$load);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user=$this->userRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }

    }
    public function updateStatus($post=[])
    {
        DB::beginTransaction();
        try {
        $load[$post['field']]= (($post['value']==1)?0:1);
            $user = $this->userRepository->update($post['modelId'],$load);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
}
