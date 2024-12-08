<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::all();

        return $this->successResponse($books);
    }

    public function show(string $bookId): JsonResponse
    {
        $book = Book::findOrFail($bookId);

        return $this->successResponse($book);
    }
}
