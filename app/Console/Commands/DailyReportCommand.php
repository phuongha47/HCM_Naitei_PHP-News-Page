<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\DripEmailer;
use App\Mail\DailyReportMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Carbon\Carbon;

class DailyReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:daily';
    protected $role;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is the total number of daily posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->role = config('role.admin');
        $users = DB::table('users')
            ->select('*')
            ->where('role_id', '=', $this->role)
            ->get();
        $posts = Post::whereDate('created_at', Carbon::today())->get();
        $count = count($posts);

        Mail::to($users)->send(new DailyReportMail($count, $posts));
    }
}
