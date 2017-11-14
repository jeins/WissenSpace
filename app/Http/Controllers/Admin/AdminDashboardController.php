<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\IProduct;
use App\Repositories\Interfaces\IUser;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;

class AdminDashboardController extends AdminController
{
    /** @var UserRepository */
    private $userRepository;

    /** @var ProductRepository */
    private $productRepository;

    public function __construct(IUser $user, IProduct $product)
    {
        parent::__construct();

        $this->userRepository = $user;
        $this->productRepository = $product;
    }

    public function index()
    {
        $userStatistic = $this->userRepository->getStatistic();
        $productStatistic = $this->productRepository->getStatistic();

        return view('admin.dashboard', compact('userStatistic', 'productStatistic'));
    }
}
