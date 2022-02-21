<?php
namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public $limit;

    public function __construct()
    {
        $this->limit = config('app.limit');
    }

    public function getModel()
    {
        return Category::class;
    }

    public function index($paginateLimit)
    {
        $categories = Category::first();

        return $categories->load('posts')->paginate($paginateLimit);
    }

    public function getCategoriesSub()
    {
        return DB::table('categories')
            ->select('*')
            ->whereNull('parent_id')
            ->get();
    }
}
