<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class UserPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'last_name',
        'first_name',
        'email',
        'position',
    ];

    public function getPositionPresent(): string
    {
        return $this->model->position->position;
    }
}
