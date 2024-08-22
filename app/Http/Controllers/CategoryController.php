<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $categories = Category::all();
        return View::make('Category.index')->with('categories',$categories);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules= array('name' => 'required');

        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return Redirect::to('category/create')->withErrors($validator);
        }

        else{
            $category = new Category;
            $category->name = $request->get('name');
            $category->save(); 

            Session::flash('message','Category created successfully.');
            return Redirect::to('category');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return View::make('Category.show')->with('category',$category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return View::make('Category.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = array('name'=>'required');
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails())
        {
            
            return Redirect::to('category/'.$id.'/edit')->withErrors($validator);
        }

        else
        {
            $category = Category::find($id);
            $category->name=$request->get('name');
            $category->save();
            Session::flash('message','category updated successfully.');
            return Redirect::to('category');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        Session::flash('message','Category deleted successfully.');
        return Redirect::to('category');
    }
}
