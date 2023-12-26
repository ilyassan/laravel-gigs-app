<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'logo','company', 'location', 'email', 'website', 'tags', 'description'];

    public function scopeFilter($query, array $filters){

        if($filters['search'] ?? false){
            
            $query->where('title', 'like', '%'. request('search') . '%')
                  ->orWhere('description', 'like', '%'. request('search') . '%')
                  ->orWhere('tags', 'like', '%'. request('search') . '%')
                  ->orWhere('company', 'like', '%'. request('search') . '%');
                  
        }elseif($filters['tag'] ?? false) {

            $query->where('tags', 'like', '%'. request('tag') . '%');

        }
    }

    // Relationship To User
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}