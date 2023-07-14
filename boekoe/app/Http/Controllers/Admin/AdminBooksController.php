<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Photo;
use Illuminate\Support\Facades\DB;

class AdminBooksController extends Controller
{
    public function index()
    {
        $books = Book::with('category', 'author', 'image')
            ->orderBy('id', 'DESC')
            ->get();
        return view('admin.books.index', compact('books'));
    }
    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' =>'required|max:100',
            'slug' =>'required|max:100|unique:books',
            'description' =>'required|max:250',
            'author_id' =>'required',
            'category_id' =>'required',
            'image_id' => 'image|max:1000',
            'quantity' =>'numeric|min:0',
            'price' =>'numeric|min:0'
        ];

        $message = [
            'image_id.image' => 'Image should be PNG, jpg, jpeg type'
        ];

        $this->validate($request, $rules, $message);


        $input = $request->all();

        if($file = $request->file('image_id'))
        {
            $name = time().$file->getClientOriginalName();

            $image_resize = Photo::make($file->getRealPath());
            $image_resize->resize(340,380);
            $image_resize->save(public_path('assets/img/' .$name));

            $image = Image::create(['file'=>$name]);
            
            $input['image_id'] = $image->id;
        }
        
        $create_book = Book::create($input);

        return redirect('/admin/books')
            ->with('success_message', 'Book created successfully');

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

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));

    }
    public function update(Request $request, $id)
    {
        $rules = [
            'title'         => 'required',
            'slug'          => 'required|unique:books,slug,'.$id,
            'description'   => 'required',
            'author_id'     => 'required',
            'category_id'   => 'required',
            'image_id'      => 'image|max:1000',
            'price'         => 'required|numeric|min:0',
            'quantity'      => 'required|numeric|min:0'
        ];

        $message = [
            'image_id.image' => 'Image should be PNG, jpg, jpeg type'
        ];

        $this->validate($request, $rules, $message);

        $input = $request->all();

        $input['price'] =  $request->price;

        if($file = $request->file('image_id'))
        {
            $name = time().$file->getClientOriginalName();

            $image_resize = Photo::make($file->getRealPath());
            $image_resize->resize(340,380);
            $image_resize->save(public_path('assets/img/' .$name));

            $image = Image::create(['file'=>$name]);
            $input['image_id'] = $image->id;
        }

        $book = Book::findOrFail($id);
        $book->update($input);
        return redirect('/admin/books')
            ->with('success_message', 'Book updated successfully');

    }

    public function destroy($id)
    {
        $book= Book::findOrFail($id);
        $book->delete();
        return redirect()->back()->with('alert_message', 'Book move to trash');
    }

    public function restore($id)
    {
        $trash = Book::onlyTrashed()->findOrFail($id);
        $trash->restore();
        return redirect()->back()
            ->with('success_message', 'Book successfully restore from trash');
    }

    public function forceDelete($id)
    {
        $trash_book = Book::onlyTrashed()->findOrfail($id);
        if(!is_null($trash_book->image_id))
        {
            unlink(public_path().'/assets/img/'.$trash_book->image->file);
        }
        $trash_book->image->delete();
        $trash_book->forceDelete();
        return redirect()->back()
            ->with('alert_message', 'Book deleted permanently');
    }

    public function trashBooks()
    {
        $books = Book::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('admin.books.trash-books', compact('books'));
    }
}
