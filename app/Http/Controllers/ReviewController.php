<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Service;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ReviewController extends Controller
{

    public function store(Request $request, $type, $id)
    {

        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'rating'  => 'required|string|min:1|max:5'
        ]);

        $model = $this->SelectModel($type);


        $review = $model::findOrFail($id);
        Review::where([
            'user_id'         => Auth::user()->id,
            'reviewable_type' => $model,
            'reviewable_id'   => $id,
        ]);

        $review->reviews()->create([
            'comment' => $request->comment,
            'rating'  => $request->rating,
            'user_id' => Auth::user()->id
        ]);
        return 'sss';
    }
    public function SelectModel($type)
    {
        return match ($type) {
            'product' => Product::class,
            'store'   => Store::class,
            'servies' => Service::class,
        };
    }
}
