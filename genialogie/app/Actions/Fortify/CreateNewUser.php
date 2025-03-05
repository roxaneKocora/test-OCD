<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\Person;
use App\Models\Invitation;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        if(isset($input['code'])){
            Validator::make($input, [
                'code'=>['required','exists:invitations,code'],
                'pseudo' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique(User::class),
                ],

                'password' => ['required','string','min:6'],
            ])->validate();
        }else{
            Validator::make($input, [
                'pseudo' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => ['required','string','min:6'],
               // 'password' => $this->passwordRules(),
               'first_name'=>['required', 'string','max:255','regex:/^[a-zA-Z]+$/'],
                'last_name'=>['required', 'string','max:255','regex:/^[A-Z]+$/'],
                'birth_name'=>['nullable', 'string','max:255','regex:/^[A-Z]+$/'],
                'middle_names'=>['nullable', 'string','max:255'],
                'date_of_birth'=>['nullable', 'date_format:Y-m-d']
            ])->validate();
        }


        //Créer l'utilisateur
        $user = User::create([
            'pseudo' => $input['pseudo'],
            'password' => Hash::make($input['password']),
        ]);

        if(! isset($input['code'])){
            //Lui créer directment sa fiche personnelle
            Person::create([
                'first_name' =>$input['first_name'],
                'last_name' =>$input['last_name'],
                'birth_name' => $input['birth_name'] ?: $input['last_name'],
                'middle_names' => $this->formatMiddleNames($input['middle_names']),
                'date_of_birth' =>$input['date_of_birth'],
                'created_by'=> $user->id,
            ]);
        }else{

            $invitation = Invitation::where('code',$input['code'])->first();

            Person::find($invitation->person_id)->update([
                'created_by'=> $user->id,
            ]);

            $invitation->update([
                'validated_at'=>now(),
            ]);
        }

        return $user;
    }

    /** Format de la column */
    protected function formatMiddleNames($middleNames)
    {
        if (empty($middleNames)) {
            return null;
        }

        $middleNamesArray = explode(',', $middleNames);
        $formattedMiddleNames = array_map(function ($name) {
            return ucfirst(strtolower(trim($name)));
        }, $middleNamesArray);

        return implode(', ', $formattedMiddleNames);
    }
}
