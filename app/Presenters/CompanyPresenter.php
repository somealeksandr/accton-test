<?php

namespace App\Presenters;

use SomePackage\Presenter\AbstractPresenter;

class CompanyPresenter extends AbstractPresenter
{
    protected $arrayable = [
        'id',
        'name',
        'address',
        'users',
    ];

    public function getUsersPresent(): object
    {
        return $this->model->users;
    }
}
