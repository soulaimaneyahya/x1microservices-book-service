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

    public function store(Request $request): JsonResponse
    {
        // numeric value. // it can be an integer or a float
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:700',
            'price' => 'required|numeric|min:0.01',
            'author_id' => 'required|string|max:255',
        ];

        $this->validate($request, $rules);

        $book = Book::create($request->only(array_keys($rules)));

        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    public function show(string $bookId): JsonResponse
    {
        $book = Book::findOrFail($bookId);

        return $this->successResponse($book);
    }

    public function update(Request $request, string $bookId): JsonResponse
    {
        $rules = [
            'title' => 'string|max:255',
            'description' => 'string|max:700',
            'price' => 'numeric|min:0.01',
            'author_id' => 'string|max:255',
        ];

        $this->validate($request, $rules);

        $book = Book::findOrFail($bookId);

        $book->fill($request->only(array_keys($rules)));

        if ($book->isClean()) {
            return $this->errorResponse(
                'At least one value must change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $book->save();

        return $this->successResponse($book);
    }

    public function destroy(string $bookId): JsonResponse
    {
        $book = Book::findOrFail($bookId);

        if ($book instanceof Book) {
            $book->delete();
        }

        return $this->jsonResponse([], Response::HTTP_RESET_CONTENT);
    }
}
