<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cooperative;
use App\Models\Province;
use App\Models\Town;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    public function provinces(Request $request)
    {
        $term = $request->term ?: '';

        if ($request->search) {
            $term = $request->search;
        }

        return Province::select('id', 'name as text')
            ->where('name', 'like', '%' . $term . '%')
            ->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', [])),
                fn ($query) => $query->limit(10)
            )
            ->get();
    }

    public function towns(Request $request)
    {
        $term = $request->term ?: '';
        $provinceId = $request->province_id ?: 0;

        if ($request->search) {
            $term = $request->search;
        }

        return Town::select('id', 'name as text')
            ->where('name', 'like', '%' . $term . '%')
            ->where('province_id', $provinceId)
            ->when($request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', [])),
                fn ($query) => $query->limit(10)
            )
            ->get();
    }

    public function cooperatives(Request $request)
    {
        $term = $request->term ?: '';

        if ($request->search) {
            $term = $request->search;
        }

        return Cooperative::select('id', 'name as text')
            ->where('name', 'like', '%' . $term . '%')
            ->get();
    }
}
