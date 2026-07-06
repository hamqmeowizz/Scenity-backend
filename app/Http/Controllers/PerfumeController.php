<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use Illuminate\Http\Request;

class PerfumeController extends Controller
{
    public function show(Request $request, ?Perfume $perfume = null)
    {
        $perfume ??= Perfume::query()->firstOrFail();
        $inLibrary = $request->user()
            ->perfumes()
            ->where('perfumes.perfume_id', $perfume->getKey())
            ->exists();

        return view('fdetails', compact('perfume', 'inLibrary'));
    }
}
