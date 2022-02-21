<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddSubCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    private $controllerName = 'admin';
    protected $pathToView = 'admin.pages.';
    private $pathToUi = 'ui_resources/startbootstrap-sb-admin-2/';
    protected $searchKeyWord = '';
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->middleware('auth');
        // Var want to share
        view()->share('controllerName', $this->controllerName);
        view()->share('pathToUi', $this->pathToUi);
        $this->limit = config('app.limit');
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepo->index($paginateLimit=$this->limit);

        return view(
            $this->pathToView . 'search_category',
            array_merge(
                compact('categories'),
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
    public function createSubCategory()
    {
        $categoriesSub = $this->categoryRepo->getCategoriesSub();

        return view($this->pathToView . 'addSubCategory', compact(['categoriesSub']));
    }

    public function create()
    {
        return view($this->pathToView . 'addCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSubCategory(AddSubCategoryRequest $request)
    {
        if (!is_null($request->parent_id)) {
            $this->categoryRepo->create($request);
        }

        return redirect()->route('category.index');
    }

    public function storeCategory(AddCategoryRequest $request)
    {
        if (is_null($request->parent_id)) {
            $this->categoryRepo->create($request);
        }

        return redirect()->route('category.index');
    }

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
        $category = $this->categoryRepo->findOrFail($id);
        $categoriesSub = $this->categoryRepo->getCategoriesSub();

        return view($this->pathToView . 'editCategory', compact(['category', 'categoriesSub']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCategoryRequest $request, $id)
    {
        $this->categoryRepo->update($id, $request);

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->categoryRepo->delete($id);

        return redirect()->route('category.index');
    }
}
