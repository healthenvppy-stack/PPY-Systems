<?php

namespace App\Http\Controllers;

use App\Models\Citizen;

class CitizenController extends Controller
{
    public function index()
    {
        $query = Citizen::query();

        if (request('q')) {
            $q = request('q');

            $query->where(function ($sub) use ($q) {
                $sub->where('cid', 'like', "%{$q}%")
                    ->orWhere('first_name', 'like', "%{$q}%")
                    ->orWhere('last_name', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        if (request('gender')) {
            $query->where('gender', request('gender'));
        }

        if (request('status') !== null && request('status') !== '') {
            $query->where('status', request('status'));
        }

        $citizens = $query
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();

        $totalCitizens = $query->count();

        return view('citizens.index', compact('citizens', 'totalCitizens'));
    }

    public function create()
    {
        return view('citizens.create');
    }

    public function store()
    {
        request()->validate([
            'cid' => ['required', 'digits:13', 'unique:citizens,cid'],
            'first_name' => ['required', 'max:100'],
            'last_name' => ['nullable', 'max:100'],
            'gender' => ['required'],
            'birth_date' => ['nullable', 'date'],
        ]);

        Citizen::create(request()->only([
            'cid',
            'first_name',
            'last_name',
            'gender',
            'birth_date',
        ]));

        return redirect()->route('citizens.index')
            ->with('success', 'บันทึกข้อมูลประชาชนเรียบร้อยแล้ว');
    }

    public function show(Citizen $citizen)
    {
        return view('citizens.show', compact('citizen'));
    }

    public function edit(Citizen $citizen)
    {
        return view('citizens.edit', compact('citizen'));
    }

    public function update(Citizen $citizen)
    {
        request()->validate([
            'cid' => 'required|digits:13|unique:citizens,cid,' . $citizen->id,
            'first_name' => 'required|max:100',
            'last_name' => 'nullable|max:100',
            'gender' => 'required',
            'birth_date' => 'nullable|date',
        ]);

        $citizen->update(request()->only([
            'cid',
            'first_name',
            'last_name',
            'gender',
            'birth_date',
        ]));

        return redirect()
            ->route('citizens.index')
            ->with('success', 'แก้ไขข้อมูลประชาชนเรียบร้อยแล้ว');
    }

    public function destroy(Citizen $citizen)
    {
        $citizen->delete();

        return redirect()->route('citizens.index')
            ->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}