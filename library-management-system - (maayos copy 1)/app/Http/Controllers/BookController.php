<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q');
        $availability = $request->query('availability');
        $categoryId = $request->query('category_id');

        $books = Book::with('category')
            ->when($query, function ($books, $query) {
                $books->where(function ($sub) use ($query) {
                    $sub->where('title', 'like', "%{$query}%")
                        ->orWhere('author', 'like', "%{$query}%")
                        ->orWhereHas('category', function ($category) use ($query) {
                            $category->where('name', 'like', "%{$query}%");
                        });
                });
            })
            ->when($categoryId, function ($books, $categoryId) {
                $books->where('category_id', $categoryId);
            })
            ->when($availability === 'available', function ($books) {
                $books->where('available_copies', '>', 0);
            })
            ->when($availability === 'unavailable', function ($books) {
                $books->where('available_copies', '<=', 0);
            })
            ->paginate(15)
            ->withQueryString();

        $categories = Category::all();

        return view('admin.books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books|max:20',
            'category_id' => 'required|exists:categories,id',
            'total_copies' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'publisher' => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        $book = Book::create([
            ...$validated,
            'available_copies' => $validated['total_copies'],
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Added new book: {$book->title}",
            'model_type' => 'Book',
            'model_id' => $book->id,
        ]);

        return redirect('/admin/books')->with('success', 'Book added successfully.');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id . '|max:20',
            'category_id' => 'required|exists:categories,id',
            'total_copies' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'publisher' => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        $difference = $validated['total_copies'] - $book->total_copies;
        $validated['available_copies'] = $book->available_copies + $difference;

        $book->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated book: {$book->title}",
            'model_type' => 'Book',
            'model_id' => $book->id,
        ]);

        return redirect('/admin/books')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $title = $book->title;
        $book->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted book: {$title}",
            'model_type' => 'Book',
            'model_id' => $book->id,
        ]);

        return redirect('/admin/books')->with('success', 'Book deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $books = Book::where('title', 'like', "%$query%")
            ->orWhere('author', 'like', "%$query%")
            ->orWhere('isbn', 'like', "%$query%")
            ->with('category')
            ->paginate(15);

        return view('user.search', compact('books', 'query'));
    }
}
