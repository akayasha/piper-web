<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function createFeedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status code' => 400,
                'status' => 'Error',
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 400);
        }
    
        $feedback = Feedback::create([
            'message' => $request->input('message')
        ]);
    
        return response()->json([
            'status code' => 201,
            'status' => 'Success',
            'message' => 'Feedback submitted successfully',
            'data' => $feedback
        ], 201);
    }
}
