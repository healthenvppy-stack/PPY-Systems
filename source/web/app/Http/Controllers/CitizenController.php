<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Household;

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
        $households = Household::orderBy('house_code')->get();

        return view('citizens.create', compact('households'));
    }

    public function store()
    {
        request()->validate([
            'cid' => ['required', 'digits:13', 'unique:citizens,cid'],
            'first_name' => ['required', 'max:100'],
            'last_name' => ['nullable', 'max:100'],
            'gender' => ['required'],
            'birth_date' => ['nullable', 'date'],
            'household_id' => ['nullable', 'exists:households,id'],
        ]);

        Citizen::create(request()->only([
            'cid',
            'first_name',
            'last_name',
            'gender',
            'birth_date',
            'household_id',
        ]));

        return redirect()->route('citizens.index')
            ->with('success', 'บันทึกข้อมูลประชาชนเรียบร้อยแล้ว');
    }

    public function show(Citizen $citizen)
    {
        //$citizen->load('household');
        $citizen->load([
            'household',
            'household.citizens',
            'serviceCases.timelines',
            'welfareProfile',
            'healthProfile',
        ]);

        return view('citizens.show', compact('citizen'));
    }

    public function edit(Citizen $citizen)
    {
        $households = Household::orderBy('house_code')->get();

        return view('citizens.edit', compact('citizen', 'households'));
    }

    public function update(Citizen $citizen)
    {
        request()->validate([
            'cid' => 'required|digits:13|unique:citizens,cid,' . $citizen->id,
            'first_name' => 'required|max:100',
            'last_name' => 'nullable|max:100',
            'gender' => 'required',
            'birth_date' => 'nullable|date',
            'household_id' => ['nullable', 'exists:households,id'],
        ]);

        $citizen->update(request()->only([
            'cid',
            'first_name',
            'last_name',
            'gender',
            'birth_date',
            'household_id',
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