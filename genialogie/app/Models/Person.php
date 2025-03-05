<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class Person extends Model
{
    protected $table = 'people';

    // Colonnes
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_name',
        'middle_names',
        'date_of_birth',
        'created_by'
    ];

    /**
     * Relation : Une personne a plusieurs enfants
     */
    public function enfants()
    {
        return $this->belongsToMany(Person::class, 'relationships', 'parent_id', 'child_id');
    }

    /**
     * Relation : Une personne a plusieurs parents
     */
    public function parents()
    {
        return $this->belongsToMany(Person::class, 'relationships', 'child_id', 'parent_id');
    }

    /**
     * Relation : Une personne appartient à un utilisateur-créateur
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function person()
    {
        return $this->hasOne(Person::class, 'person_id');
    }

    public function getDegreeWith($target_person_id)
    {
        // Vérifier si l'ID de la personne cible est valide
        if ($this->id == $target_person_id) {
            return 0;  // La même personne, degré de parenté est 0
        }

        // Recherche en largeur (BFS)
        $visited = [];
        $queue = [
            [$this->id, 0]  // La personne courante avec un degré initial de 0
        ];

        while (!empty($queue)) {
            list($current_person_id, $degree) = array_shift($queue);

            // Si la personne cible est trouvée, retourner le degré
            if ($current_person_id == $target_person_id) {
                return $degree;
            }

            // Marquer la personne comme visitée
            $visited[$current_person_id] = true;

            // Ajouter les parents et les enfants dans la queue, s'ils n'ont pas été visités
            $current_person = Person::find($current_person_id);
            $relations = $current_person->parents()->get()->pluck('id')->toArray();
            $relations = array_merge($relations, $current_person->enfants()->get()->pluck('id')->toArray());

            //Si inferieur à 25
            foreach ($relations as $relation_id) {
                if (!isset($visited[$relation_id])) {
                    $queue[] = [$relation_id, $degree + 1];  // Ajouter la personne dans la queue avec un degré incrémenté
                }
            }
        }

        return -1;  // Si aucune connexion n'est trouvée
    }


    public function invitation()
    {
        return $this->hasOne(Invitation::class, 'person_id');  // Lien vers la table invitations, avec la clé étrangère 'person_id'
    }
}
