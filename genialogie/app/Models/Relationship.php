<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $table = 'relationships';

    // Colonnes
    protected $fillable = [
        'parent_id',
        'child_id',
        'created_by'
    ];

    /**
     * Relation : La relation appartient à un parent (personne)
     */
    public function parent()
    {
        return $this->belongsTo(Person::class, 'parent_id');
    }

    /**
     * Relation : La relation appartient à un enfant (personne)
     */
    public function child()
    {
        return $this->belongsTo(Person::class, 'child_id');
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'relationship_id');
    }
}
