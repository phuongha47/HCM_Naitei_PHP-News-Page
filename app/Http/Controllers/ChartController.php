<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function barChart(){
        $users = Post::selectRaw('DAYOFWEEK(created_at) as day, count(id) as visitors')
            ->whereBetween('created_at', [now()->subDays(7), now()])
            ->orderBy('created_at', 'ASC')
            ->groupBy('day')
            ->get();
        $datas = array(0, 0, 0, 0, 0, 0, 0);
        $days = array(0, 0, 0, 0, 0, 0, 0);
        
        foreach($users as $index => $day)
        {
            $datas[$index] = $day["visitors"];
            switch ($day["day"] + 1) {
                case '2':
                    $days[$index] = 'Mon';
                    break;
                case '3':
                    $days[$index] = 'Tues';
                    break;
                case '4':
                    $days[$index] = 'Web';
                    break;
                case '5':
                    $days[$index] = 'Thur';
                    break;
                case '6':
                    $days[$index] = 'Fri';
                    break;
                case '7':
                    $days[$index] = 'Sa';
                    break;
                default:
                    $days[$index] = 'Sun';
                    break;
            }
        }
        return view('bar-chart', compact('datas', 'days'));
    }
}
