<?php



namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact_number',
        'role_id',
        'is_frequent_shopper',
        'profile_image',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The attributes that should be treated as nullable.
     *
     * @var array<int, string>
     */
    protected $nullable = [
        'name',
        'email',
        'password',
        'contact_number',
        'profile_image',
        'role_id',
        'is_frequent_shopper',
    ];

    /**
     * Define the relationship with the Role model (if applicable).
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Define the relationship with the user's address (optional).
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }
    
}
