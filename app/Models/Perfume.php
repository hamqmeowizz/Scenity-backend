<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
    protected $table = 'perfumes';

    protected $primaryKey = 'perfume_id';

    protected $fillable = [
        'name',
        'brand',
        'scent_family',
        'top_notes',
        'middle_notes',
        'base_notes',
        'longevity',
        'sillage',
        'weather_suitability',
        'image_url',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'library', 'perfume_id', 'user_id')
            ->withPivot(['library_id', 'rating', 'added_at']);
    }
}
