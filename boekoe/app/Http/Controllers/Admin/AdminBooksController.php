<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Requests\BooksCreateRequest;
use App\Http\Requests\BooksUpdateRequest;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Photo;
use Illuminate\Support\Facades\DB;

class AdminBooksController extends AdminBaseController
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
    public function store(BooksCreateRequest $request)
    {
        $this->validate($request, [
            'name' =>'required|max:100|unique:categories',
            'slug' =>'required|max:100|unique:categories',
            'description' =>'required|max:250',
            'author_id' =>'required',
            'category_id' =>'required',
            'image_id' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'quantity' =>'numeric|min:0',
            'price' =>'numeric|min:0'
        ]);

        $input = $request->all();

        if($file = $request->file('image_id'))
        {
            $name = $file->getClientOriginalName();

            $image_resize = Photo::make($file->getRealPath());
            $image_resize->resize(340,380);
            $image_resize->save(public_path('assets/img/' .$name));

            $image = Image::create(['file'=>$name]);
            
            $input['image_id'] = $image->id;
        }
        
        Book::create($input);
        return redirect('/admin/books')
            ->with('success_message', 'Book created successfully');

    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));

    }
    public function update(BooksUpdateRequest $request, $id)
    {
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
