<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|unique:App\Models\Category,name",
        ]);

        $category = Category::create($request->all());
        session()->flash('create_status', "The category '$category->name' was successfully created");
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', ['category'=> $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        if($category->name === Str::slug(Str::lower($request->name), "-") && $category->id == $request->id){
            session()->flash('update_status', "No changes has made to the category name");
            return redirect()->route('categories.index');
        }

        $form = $request->all();
        $validator = Validator::make($form,[
            'name' => ['required', Rule::unique('categories')->ignore($category->id)],
        ]);

        if($validator->fails()){
            return redirect()->route('categories.edit', ['category' => $category])
            ->withErrors($validator)
            ->withInput();
        }else{
            $category->update($request->all());
        }

        if($category->wasChanged()){
            session()->flash('update_status', "The category '$category->name' was successfully updated");
        }else{
            session()->flash('update_status', "No changes was made");
        }

        
        return redirect()->route('categories.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        session()->flash('destroy_status', "The category '$category->name' was successfully deleted");
        
        return redirect()->route('categories.index');
    }

    public function sort(Category $category){
        $categories = Category::all();
        $posts = $category->posts()->paginate(5);
        return view('categorized-page', ['category' => $category, 'posts' => $posts, 'categories' => $categories]);
    }
}
