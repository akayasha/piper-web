<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Branch;
use App\Models\PriceBranch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PriceBranchController extends Controller
{
    public function getPriceByBranchId(Request $request, $branch_id)
    {
        $perPage = $request->input('per_page', 10); 
        $priceBranch = PriceBranch::where('branch_id', $branch_id)->paginate($perPage);

        if ($priceBranch->isEmpty()) {
            return response()->json(['message' => 'Harga tidak ditemukan untuk cabang ini'], 404);
        }

        $prices = $priceBranch->map(function ($price) {
            return [
                $price->strip => $price->price
            ];
        });

        return response()->json([
            'branch_id' => $branch_id,
            'prices' => $prices,
            'pagination' => [
                'current_page' => $priceBranch->currentPage(),
                'total_pages' => $priceBranch->lastPage(),
                'total_items' => $priceBranch->total(),
                'per_page' => $priceBranch->perPage(),
            ]
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|uuid|exists:branches,id', 
            'prices' => 'required|array|min:1', 
            'prices.*' => 'array',
        ]);

        $branch_id = $validated['branch_id'];
        $prices = $validated['prices'];

        $branch = Branch::find($branch_id);
        if (!$branch) {
            return response()->json(['message' => 'Cabang tidak ditemukan'], 404);
        }

        foreach ($prices as $priceData) {
            foreach ($priceData as $strip => $price) {
                PriceBranch::create([
                    'branch_id' => $branch_id, 
                    'strip' => $strip, 
                    'price' => $price, 
                ]);
            }
        }

        return response()->json([
            'message' => 'Harga berhasil ditambahkan',
            'branch_id' => $branch_id, 
            'prices' => $prices  
        ], 201);
    }


}
