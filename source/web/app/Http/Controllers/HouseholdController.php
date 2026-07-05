<?php

namespace App\Http\Controllers;

use App\Models\Household;

class HouseholdController extends Controller
{
    public function index()
    {
        $query = Household::query();

        if (request('q')) {
            $q = request('q');
            $query->where('house_code', 'like', "%{$q}%")
                ->orWhere('house_no', 'like', "%{$q}%")
                ->orWhere('moo', 'like', "%{$q}%");
        }

        $households = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();

        return view('households.index', compact('households'));
    }

    public function create()
    {
        return view('households.create');
    }

    public function store()
    {
        request()->validate([
            'house_code' => 'required|max:20|unique:households,house_code',
            'house_no' => 'required|max:20',
            'moo' => 'nullable|max:10',
            'road' => 'nullable|max:255',
            'alley' => 'nullable|max:255',
            'postcode' => 'nullable|max:5',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'flood_level' => 'required|integer|min:0|max:4',
        ]);

        Household::create(request()->only([
            'house_code',
            'house_no',
            'moo',
            'road',
            'alley',
            'postcode',
            'latitude',
            'longitude',
            'flood_level',
        ]));

        return redirect()->route('households.index')->with('success', 'บันทึกข้อมูลบ้านเรียบร้อยแล้ว');
    }

    public function show(Household $household)
    {
        $household->load('citizens');

        return view('households.show', compact('household'));
    }

    public function edit(Household $household)
    {
        return view('households.edit', compact('household'));
    }

    public function update(Household $household)
    {
        request()->validate([
            'house_code' => 'required|max:20|unique:households,house_code,' . $household->id,
            'house_no' => 'required|max:20',
            'moo' => 'nullable|max:10',
            'road' => 'nullable|max:255',
            'alley' => 'nullable|max:255',
            'postcode' => 'nullable|max:5',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'flood_level' => 'required|integer|min:0|max:4',
        ]);

        $household->update(request()->only([
            'house_code',
            'house_no',
            'moo',
            'road',
            'alley',
            'postcode',
            'latitude',
            'longitude',
            'flood_level',
        ]));

        return redirect()->route('households.index')->with('success', 'แก้ไขข้อมูลบ้านเรียบร้อยแล้ว');
    }

    public function destroy(Household $household)
    {
        $household->delete();

        return redirect()->route('households.index')->with('success', 'ลบข้อมูลบ้านเรียบร้อยแล้ว');
    }
}