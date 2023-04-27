<?php

namespace App\Interfaces;

interface IPostRepository
{
    public function getAll();
    public function getById($id);
    public function save($details);
    public function update($id, $newDetails);
    public function delete($id);
}