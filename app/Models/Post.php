<?php

namespace App\Models;

use App\Models\category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'author', 'slug', 'description', 'featured', 'tags', 'image'];

    // One-One relationship with category
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // One-Many relationship with comment
    public function comments() {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    // Filter post with required parameter
    public function scopeFilter($query, array $filters) {
        if (isset($filters['tag'])) {
            return $query->where('tags', 'LIKE', '%' . $filters['tag'] . '%');
        }
        else if (isset($filters['category'])) {
            return $query->where('category_id', $filters['category']);
        }
        else if (isset($filters['search'])) {
            return $query->where('title', 'LIKE', '%' . $filters['search'] . '%')
                        ->orWhere('author', 'LIKE', '%' . $filters['search'] . '%')
                        ->orWhere('description', 'LIKE', '%' . $filters['search'] . '%')
                        ->orWhere('tags', 'LIKE', '%' . $filters['search'] . '%');
        } 
    }
}
