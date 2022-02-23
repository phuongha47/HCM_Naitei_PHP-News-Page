<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Carbon\Carbon;

class AdminController extends Controller
{
    protected $controllerName = 'admin';
    protected $pathToView = 'admin.pages.';
    protected $pathToUi = 'ui_resources/startbootstrap-sb-admin-2/';

    public function __construct()
    {
        $this->middleware('auth');
        // Var want to share
        view()->share('controllerName', $this->controllerName);
        view()->share('pathToUi', $this->pathToUi);
    }

    public function index()
    {
        $posts = Post::selectRaw('DATE(created_at) as date, count(id) as count')
            ->whereBetween('created_at', [now()->subDays(7), now()])
            ->orderBy('created_at', 'ASC')
            ->groupBy('date')
            ->get();
        $datas = $days = [0, 0, 0, 0, 0, 0, 0];
        
        foreach ($posts as $index => $post) {
            $datas[$index] = $post['count'];
            $days[$index] = $post['date'];
            $days[$index] = $days[$index] . "\n" . Carbon::createFromFormat('Y-m-d', $post['date'])->format('l');
        }
        
        return view($this->pathToView.'dashboard', compact('datas', 'days'));
    }
}
