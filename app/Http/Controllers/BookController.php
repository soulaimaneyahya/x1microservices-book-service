<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::all();

        return $this->successResponse($books);
    }

    /**
     * Create one new book
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // numeric value. // it can be an integer or a float
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:700',
            'price' => 'required|numeric|min:0.01',
            'author_id' => 'required|string|max:255',
        ];

        $this->validate($request, $rules);

        $book = Book::create($request->validated());

        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    public function show(string $bookId): JsonResponse
    {
        $book = Book::findOrFail($bookId);

        return $this->successResponse($book);
    }

    /**
     * Update an existing book
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $book)
    {
        $rules = [
            'title' => 'string|max:255',
            'description' => 'string|max:700',
            'price' => 'numeric|min:0.01',
            'author_id' => 'string|max:255',
        ];

        $this->validate($request, $rules);

        $book = Book::findOrFail($book);

        $book->fill($request->validated());

        if ($book->isClean()) {
            return $this->errorResponse(
                'At least one value must change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $book->save();

        return $this->successResponse($book);
    }

    /**
     * Remove an existing book
     * @return Illuminate\Http\Response
     */
    public function destroy($book)
    {
        $book = Book::findOrFail($book);

        $book->delete();

        return $this->successResponse($book);
    }
}
