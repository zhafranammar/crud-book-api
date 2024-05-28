<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('author', 'LIKE', "%{$search}%")
                ->orWhere('publisher', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        }

        $books = $query->paginate(10);

        return response()->json([
            'code' => 200,
            'message' => 'Get Book Data successful',
            'data' => $books,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'publisher' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $existingBook = Book::where('title', $request->title)
            ->where('year', $request->year)
            ->where('publisher', $request->publisher)
            ->where('author', $request->author)
            ->first();

        if ($existingBook) {
            return response()->json([
                'code' => 400,
                'message' => 'The combination of title, year, publisher, and author has already been taken.',
                'data' => null,
            ], 400);
        }

        $book = Book::create($request->all());

        return response()->json([
            'code' => 201,
            'message' => 'Book created successfully',
            'data' => $book,
        ], 201);
    }

    public function show($id)
    {
        $book = Book::find($id);
        if ($book) {
            return response()->json([
                'code' => 200,
                'message' => 'Get Book Data successful',
                'data' => $book,
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Book not found',
                'data' => null,
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if ($book) {
            $request->validate([
                'title' => 'string|max:255',
                'year' => 'integer',
                'publisher' => 'string|max:255',
                'author' => 'string|max:255',
                'description' => 'string',
            ]);

            try {
                $book->update($request->all());

                return response()->json([
                    'code' => 200,
                    'message' => 'Book updated successfully',
                    'data' => $book,
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'code' => 500,
                    'message' => 'An error occurred while updating the book',
                    'data' => null,
                ], 500);
            }
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Book not found',
                'data' => null,
            ], 404);
        }
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        if ($book) {
            try {
                $book->delete();

                return response()->json([
                    'code' => 200,
                    'message' => 'Book deleted successfully',
                    'data' => null,
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'code' => 500,
                    'message' => 'An error occurred while deleting the book',
                    'data' => null,
                ], 500);
            }
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Book not found',
                'data' => null,
            ], 404);
        }
    }
}
