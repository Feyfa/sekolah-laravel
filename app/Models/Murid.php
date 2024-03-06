<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['username'] ?? false, function($query, $username) {
            return $query->where(function($query) use($username) {
                $query->where('user', $username);
            });
        });

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }
}
