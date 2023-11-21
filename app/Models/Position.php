<?php

namespace App\Models;

use App\Presenters\UserPresenter;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SomePackage\Presenter\PresenterTrait;

class Position extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'id',
        'position',
        'company_id',
        'user_id',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
