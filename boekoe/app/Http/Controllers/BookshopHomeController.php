<?php

namespace App\Http\Controllers;
use App\Author;
use GrahamCampbell\Markdown\Facades\Markdown;
use App\Book;
use App\Category;
use Illuminate\Http\Request;

class BookshopHomeController extends Controller
{
    public function index()
    {
        # Home page Books
        $books = Book::with('author', 'image', 'category')
                    ->orderBy('id', 'DESC')
                    ->search(request('term')) #...Search Query
                    ->paginate(16);
        return view('public.book-page', compact('books'));
    }
    public function allBooks()
    {
        # ComposerServiceProvider load here
        $books = Book::with('author', 'image', 'category')
                    ->orderBy('id', 'DESC')
                    ->search(request('term')) #...Search Query
                    ->paginate(16);
        return view('public.book-page', compact('books'));
    }
    /*
     * Books filter by category
     */
    public function category(Category $category)
    {
        $categoryName = $category->name;
        $books = $category->books()
            ->with('category', 'author', 'image')
            ->orderBy('id','DESC')
            ->paginate(16);
        return view('public.book-page', compact('books', 'categoryName'));
    }
    /*
     * Books filter by author
     */
    public function author(Author $author)
    {
        $authorName = $author->name;
        $books = $author->books()
            ->with('category', 'author', 'image')
            ->orderBy('id', 'DESC')
            ->paginate(12);
        return view('public.book-page', compact('books', 'authorName'));
    }

    public function bookDetails($id)
    {
        $book = Book::findOrFail($id);
        $book_reviews = $book->reviews()->latest()->get();
        return view('public.book-details' , compact('book', 'book_reviews'));
    }
}
