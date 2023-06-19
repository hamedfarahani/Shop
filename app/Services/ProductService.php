<?php

namespace App\Services;

use App\Filter\ProductFilter;
use App\Models\AttributeProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        private AttributeProductValueServiceInterface $attributeProductValueService,
        private ProductFilter $productFilter
    )
    {
    }

    public function index()
    {
        $products = Product::filter($this->productFilter);
        return getOrPaginate($products);
    }

    public function store($validatedData)
    {

        DB::beginTransaction();

        try {

            $product = Product::create([
                'user_id' => auth()->user()->id, //TODO
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'image_location' => $validatedData['image'],
            ]);

            // Save the attribute values for the product
            foreach ($validatedData['attributes'] as $attributeData) {
                $attributeProduct = new AttributeProduct();
                $attributeProduct->product_id = $product->id;
                $attributeProduct->attribute_id = $attributeData['id'];
                $attributeProduct->save();

                foreach ($attributeData['values'] as $attributeValueData) {
                    $this->attributeProductValueService->store($attributeValueData, $attributeProduct->id);
                }
            }
            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

    }

    public function update(array $validatedData)
    {
        DB::beginTransaction();

        try {
            $product = Product::lockForUpdate()->findOrFail($validatedData['id']);
            $product->title = $validatedData['title'];
            $product->description = $validatedData['description'];
            $product->image_location = $validatedData['image'];
            $product->save();

            $product->attributes()->detach();

            foreach ($validatedData['attributes'] as $attributeData) {
                $attributeProduct = new AttributeProduct();
                $attributeProduct->product_id = $product->id;
                $attributeProduct->attribute_id = $attributeData['id'];
                $attributeProduct->save();

                foreach ($attributeData['values'] as $attributeValueData) {
                    $this->attributeProductValueService->store($attributeValueData, $attributeProduct->id);
                }
            }

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
