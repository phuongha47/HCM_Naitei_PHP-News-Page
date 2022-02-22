<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    private $controllerName = 'admin';
    protected $pathToView = 'admin.pages.';
    private $pathToUi = 'ui_resources/startbootstrap-sb-admin-2/';
    protected $searchKeyWord = "";
    protected $userRepo;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        // Var want to share
        view()->share('controllerName', $this->controllerName);
        view()->share('pathToUi', $this->pathToUi);
        $this->limit = config('app.limit');
        $this->userRepo = $userRepo;
    }
    public function index()
    {
        try {
            $users = $this->userRepo->getAll();
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('post.index')->withError($exception->getMessage())->withInput();
        }
        return view(
            $this->pathToView . 'listUser',
            array_merge(
                compact('users'),
                [
                    'searchKeyWord' => $this->searchKeyWord,
                ]
            )
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->pathToView . 'addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddRequest $request)
    {
        $password = Hash::make($request->password);
        $user = $this->userRepo->create($request);
        
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepo->edit($id);

        return view($this->pathToView . 'editUser', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $this->userRepo->update($id, $request);
        
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepo->delete($id);

        return redirect()->route('user.index');
    }
    
    public function search(Request $request)
    {
        $results = $this->userRepo->search($request);
        $users = $results[0];
        $searchKeyWord = $results[1];
        return view($this->pathToView . 'listUser', compact('users', 'searchKeyWord'));
    }
}
