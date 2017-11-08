<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\IProduct;
use App\Repositories\ProductRepository;

class ProductController extends AdminController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(IProduct $productInterface)
    {
        parent::__construct();
        $this->productRepository = $productInterface;
    }

    public function getAll()
    {
        return response()->json($this->productRepository->getAll());
    }
}
