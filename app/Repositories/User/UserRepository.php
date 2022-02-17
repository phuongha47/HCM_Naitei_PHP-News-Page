<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Models\User;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }
    public function search($key)
    {
        $searchKeyWord = $key->input('search');
        $users = User::where('name', 'LIKE', "%{$key}%")
            ->orWhere('email', 'LIKE', "%{$key}%")
            ->orderBy('id', 'DESC')
            ->paginate($this->limit);

        return [$users, $searchKeyWord];
    }
}
