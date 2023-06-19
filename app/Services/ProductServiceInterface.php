<?php

namespace App\Services;

interface ProductServiceInterface
{
    public function index();
    public function store(array $data);
    public function update(array $data);
    public function delete();
}
