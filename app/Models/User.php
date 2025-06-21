<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasHashid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasHashid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'profissionals_id',
        'status',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtenha os atributos que devem ser lançados.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    protected $appends = ['profissional_data'];

    /**
     * Obtenha o Profissional que possui o Usuário
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
//    public function profissional()
//    {
//        return $this->belongsTo(Profissional::class, 'profissionals_id');
//        // Especificamos o nome personalizado da FK
//    }
    public function profissional()
    {
        return $this->belongsTo(Profissional::class, 'profissionals_id');
        // Indica que users.profissionals_id aponta para um profissional
    }

    /**
     * Obtenha o nome do usuário
     *
     * @return string
     */
    public function getProfissionalDataAttribute()
    {
        return cache()->remember("user_{$this->id}_profissional_data", 3600, function() {
            $this->loadMissing('profissional');

            return [
                'id' => $this->profissional->id ?? null,
                'nome' => $this->profissional->nome ?? $this->name,
                'thumbnail' => $this->profissional->thumbnail ? asset($this->profissional->thumbnail) : null,
            ];
        });
    }

    public function isProfissional()
    {
        return $this->role === 'profissional';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }

}
