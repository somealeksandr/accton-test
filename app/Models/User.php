<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Presenters\UserPresenter;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use SomePackage\Presenter\PresenterTrait;

class User extends Authenticatable
{
    use HasApiTokens, PresenterTrait, UsesUuid, HasFactory, Notifiable;

    protected string $presenter = UserPresenter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
    ];

    public function position(): HasOne
    {
        return $this->hasOne(Position::class);
    }
}
