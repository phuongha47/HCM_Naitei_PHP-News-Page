<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'parent_id'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getParentsNames()
    {
        if ($this->parent) {
            return $this->parent->getParentsNames() . " > " . $this->name;
        }
        else {
            return $this->name;
        }
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }
}
