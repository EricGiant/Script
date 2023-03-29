<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    //store comment in DB
    public function store(Request $request)
    {
        DD($request);
    }
    
    //edit selected comment
    public function edit($id)
    {
        //
    }

    //update selected comment in DB
    public function update(Request $request, $id)
    {
        //
    }

    //remove selected comment in DB
    public function destroy($id)
    {
        //
    }
}
