<?php

namespace App\Controllers;

use App\Models\Post;

class PostController
{
    public function index()
    {
        echo "Hello gam";
    }

    public function create()
    {
       echo "create";
    }
    
    public function store()
    {
       echo "Store";
    }

    public function show($id)
    {
       echo "$id";
    }

    public function edit($id)
    {
       echo "Edit edit Edit $id";
    }

    public function update($id, $data)
    {
       echo "update";
    } 
    
    public function destroy($id)
    {
       echo "destroy";
    }
}