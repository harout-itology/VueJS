<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use App\Http\Resources\TemplateResource;

class TemplateController extends Controller
{

    public function index()
    {
        return  response()->json(TemplateResource::collection(Template::where('parent_id', 0)
            ->with(rtrim(str_repeat('children.', Template::$level), '.'))
            ->get()));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
