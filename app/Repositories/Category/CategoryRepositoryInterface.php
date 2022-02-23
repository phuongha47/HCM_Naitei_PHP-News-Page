<?php
namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getModel();
    public function index($paginateLimit);
    public function getCategoriesSub();
}
