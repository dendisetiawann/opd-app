<?php

namespace App\Http\Controllers;

use App\Models\TechOption;
use Illuminate\Http\JsonResponse;

class TechOptionController extends Controller
{
    /**
     * Return grouped tech options for a given category.
     * GET /api/tech-options/{kategori}
     */
    public function index(string $kategori): JsonResponse
    {
        $allowed = ['bahasa', 'framework', 'library', 'dbms'];
        
        if (!in_array($kategori, $allowed)) {
            return response()->json(['error' => 'Kategori tidak valid'], 400);
        }

        return response()->json(TechOption::groupedByName($kategori));
    }
}
