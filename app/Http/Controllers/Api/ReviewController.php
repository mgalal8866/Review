<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\Service;
use App\Models\Store;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ReviewController extends Controller
{

    public function store(Request $request, $type, $id)
    {

       $request->validate([
            'comment' => 'required|string|max:1000',
            'rating'  => 'required|string|min:1|max:5',
           
        ]);


        $modelclass = Relation::getMorphedModel($type);



        $reviewexist =  Review::where([
            'user_id'         => Auth::user()->id,
            'reviewable_type' => $type,
            'reviewable_id'   => $id,
        ])->first();

        if ($reviewexist) {

            return response()->json(['message' => 'You can only review this item once', 'status' => 'error', 'code' => 400]);
        }

        $model = $modelclass::findOrFail($id);


        $review =  $model->reviews()->create([
            'comment' => $request->comment,
            'rating'  => $request->rating,
            'user_id' => Auth::user()->id
        ]);

        return response()->json(['data' => $review, 'message' => 'Created Success ', 'status' => 'success', 'code' => 200]);
    }
  
}
