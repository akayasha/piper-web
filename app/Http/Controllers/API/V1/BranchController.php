<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

// MODELS
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Branch::all();
            return response()->json([
                'data' => $data,
                'message' => 'Data retrieved successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Branch::find($id);
            if (!$data) {
                return response()->json([
                    'message' => 'Data not found',
                ], 404);
            }

            return response()->json([
                'data' => $data,
                'message' => 'Data retrieved successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
