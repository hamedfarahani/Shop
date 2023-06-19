<?php

namespace App\Services;

use App\Models\AttributeProductValue;

class AttributeProductValueService implements AttributeProductValueServiceInterface
{

    public function store($attributeValueData, $attributeProductId)
    {
        $attributeProductValue = new AttributeProductValue();
        $attributeProductValue->attribute_product_id = $attributeProductId;
        $attributeProductValue->label = $attributeValueData['label'];
        $attributeProductValue->value = $attributeValueData['value'];
        $attributeProductValue->price = $attributeValueData['price'];
        $attributeProductValue->sell_count = $attributeValueData['sell_count'];

        $attributeProductValue->save();
    }

    public function update($attributeValueData, $attributeProductValueId, $attributeProductId)
    {
        $attributeProductValue = AttributeProductValue::updateOrCreate(
            ['id' => $attributeProductValueId, 'attribute_product_id' => $attributeProductId],
            [
                'label' => $attributeValueData['label'],
                'value' => $attributeValueData['value'],
                'price' => $attributeValueData['price'],
                'sell_count' => $attributeValueData['sell_count'],
            ]
        );
    }


}
