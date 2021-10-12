<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    CONST GENDER = [
        'MALE' => 'male',
        'FEMALE' => 'female'
    ];

    CONST RESOURCE_KEY= 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setFather(User $father)
    {
        $father->save();

        $this->father_id = $father->id;
        $this->save();

        return $father;
    }

    public function setMother(User $mother)
    {
        $mother->save();

        $this->mother_id = $mother->id;
        $this->save();

        return $mother;
    }

    public function setWife(User $wife, $marriage_date)
    {
        $wife->save();

        $this->save();

        $this->wife()->save($wife, [
            'marriage_date' => $marriage_date
        ]);

        return $wife;
    }

    public function setHusband(User $husband, $marriage_date)
    {
        $husband->save();

        $this->save();

        $this->husband()->save($husband, [
            'marriage_date' => $marriage_date
        ]);

        return $husband;
    }

    public function siblings()
    {
        if (is_null($this->father_id) && is_null($this->mother_id) && is_null($this->parent_id)) {
            return collect([]);
        }

        return User::where('id', '!=', $this->id)
            ->where(function ($query) {
                if (!is_null($this->father_id)) {
                    $query->where('father_id', $this->father_id);
                }

                if (!is_null($this->mother_id)) {
                    $query->orWhere('mother_id', $this->mother_id);
                }

                if (!is_null($this->parent_id)) {
                    $query->orWhere('parent_id', $this->parent_id);
                }

            })->get();
    }

    public function grandFatherToMyFather()
    {
        if(is_null($this->father_id)) return null;

        return User::where('id', function ($query) {
            $query->select('father_id')
                ->from(User::RESOURCE_KEY)
                ->where('id', $this->father_id);
        })->first();
    }

    public function grandMotherToMyFather()
    {
        if(is_null($this->mother_id)) return null;

        return User::where('id', function ($query) {
            $query->select('mother_id')
                ->from(User::RESOURCE_KEY)
                ->where('id', $this->father_id);
        })->first();
    }

    public function grandFatherToMyMother()
    {
        if(is_null($this->father_id)) return null;

        return User::where('id', function ($query) {
            $query->select('father_id')
                ->from(User::RESOURCE_KEY)
                ->where('id', $this->mother_id);
        })->first();
    }

    public function grandMotherToMyMother()
    {
        if(is_null($this->mother_id)) return null;

        return User::where('id', function ($query) {
            $query->select('mother_id')
                ->from(User::RESOURCE_KEY)
                ->where('id', $this->mother_id);
        })->first();
    }

    public function childs()
    {
        if ($this->gender_id == $this::GENDER['MALE']) {
            return $this->hasMany(User::class, 'mother_id');
        }

        return $this->hasMany(User::class, 'father_id');
    }

    public function father()
    {
        return $this->belongsTo(User::class);
    }

    public function mother()
    {
        return $this->belongsTo(User::class);
    }

    public function wife()
    {
        return $this->belongsToMany(User::class, 'marriages', 'husband_id', 'wife_id')->where('gender', $this::GENDER['FEMALE'])->withTimestamps()->withPivot('id');
    }

    public function husband()
    {
        return $this->belongsToMany(User::class, 'marriages', 'wife_id', 'husband_id')->where('gender', $this::GENDER['MALE'])->withTimestamps()->withPivot('id');
    }
}
