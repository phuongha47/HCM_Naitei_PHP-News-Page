<?php
namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface AdminRepositoryInterface extends RepositoryInterface
{
    public function getModel();
    public function index();
}
