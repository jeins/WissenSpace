<?php


namespace App\Repositories;


use App\Models\Product;
use App\Models\Type;
use App\Repositories\Interfaces\IProduct;

class ProductRepository implements IProduct
{

    public function getAll()
    {
        return Product::all();
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function getStatistic()
    {
        $activeProduct = Product::count();
        $inactiveProduct = Product::where('status', '<>', '1')->count();
        $productTypes = Type::all();
        $productWithType = [];

        foreach ($productTypes as $productType){
            $productWithType[$productType->name] = Product::where('type_id', '=', $productType->id)->count();
        }

        return [
            'activeProduct' => $activeProduct,
            'inactiveProduct' => $inactiveProduct,
            'productOnType' => $productWithType
        ];
    }
}