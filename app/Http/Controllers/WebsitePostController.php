<?php

namespace App\Http\Controllers;

use App\Models\WebsitePost;
use Illuminate\Http\Request;
use App\Models\Website;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class WebsitePostController extends Controller
{
    public function store(Request $request, Website $website)
    {

        try {

            $validator = Validator::make($request->all(), [
                            'title' => 'required|string|max:255',
                            'description' => 'required|string',
                        ]);

            // If validation fails, return a JSON response with error details
            if ($validator->fails()) {
                return response()->json(['success' => false,'message' => 'Validation failed','errors' => $validator->errors()], 422);
            }

            //Create a new post
            $post = new WebsitePost([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            // Save website post
            $website->posts()->save($post);

            //success
            return response()->json(['success' => true,'message' => 'Post created successfully','data' => $post], 201);

        } catch (ModelNotFoundException $e) { // Handle model not found errors
            return response()->json(['success' => false,'message' => 'Website not found','error' => $e->getMessage()], 404);
        } catch (QueryException $e) { // Handle database query errors
            return response()->json(['success' => false,'message' => 'Database error occurred','error' => $e->getMessage()], 500);
        } catch (\Exception $e) { // Catch any other exceptions
            return response()->json(['success' => false,'message' => 'An unexpected error occurred','error' => $e->getMessage()], 500);
        }
    }

}
