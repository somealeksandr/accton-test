<?php

namespace App\Models;

use App\Presenters\CompanyPresenter;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SomePackage\Presenter\PresenterTrait;

class Company extends Model
{
    use HasFactory, UsesUuid, PresenterTrait;

    protected string $presenter = CompanyPresenter::class;

    protected $fillable = [
        'id',
        'name',
        'address',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'positions', 'company_id', 'user_id');
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }
}
