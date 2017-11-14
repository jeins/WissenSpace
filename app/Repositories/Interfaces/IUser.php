<?php

namespace App\Repositories\Interfaces;

interface IUser
{
    public function getAll();
    public function get($id);
    public function getStatistic();
}