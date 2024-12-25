<?php

namespace App\Interfaces;

interface CRUDServiceInterface
{
    public function index();
    public function view(string $id);
    public function store(array $data);
    public function update(string $id, array $data);
    public function destroy(string $id);
    public function restore(string $id);
    public function forceDelete(string $id);
}
