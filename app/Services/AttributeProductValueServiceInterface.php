<?php

namespace App\Services;

interface AttributeProductValueServiceInterface
{
    public function store(array $data, int $attributeProductId);
    public function update(array $attributeValueData, int $attributeProductValueId, int $attributeProductId);
}
