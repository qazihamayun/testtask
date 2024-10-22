<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Models\Website;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request, Website $website)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'password' => 'required|min:8|max:32',
        ]);

        // If validation fails
        if ($validator->fails()) {
            return response()->json(['success' => false,'message' => 'Validation failed','errors' => $validator->errors()], 422);
        }

        try {

            $user = User::firstOrCreate(['email' => $request->email], ['name'=>$request->name, 'password' => $request->password]);

            if ($website->subscribers()->where('user_id', $user->id)->exists()) {
                return response()->json(['success' => false,'message' => 'You are already subscribed to this website'], 409);
            }


            $website->subscribers()->syncWithoutDetaching([$user->id]);

            //success
            return response()->json(['success' => true,'message' => 'Subscription successful','data' => [
                    'email' => $user->email,
                    'website' => $website->title,
                ]
            ], 201);


        } catch (QueryException $e) { // Handle any query/database related errors
            return response()->json(['success' => false,'message' => 'Database error occurred','error' => $e->getMessage()], 500);
        } catch (\Exception $e) { // Catch any general exceptions
            return response()->json(['success' => false,'message' => 'An unexpected error occurred','error' => $e->getMessage()], 500);
        }
    }

}
