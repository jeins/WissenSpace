<?php

namespace App\Repositories\Interfaces;


interface IProduct
{
    public function getAll();
    public function get($id);
    public function getStatistic();
}