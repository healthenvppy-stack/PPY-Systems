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

        /*
        |--------------------------------------------------------------------------
        | Filter : Village
        |--------------------------------------------------------------------------
        */

        if (request('moo')) {

            $query->whereHas('household', function ($q) {

                $q->where('moo', request('moo'));

            });

        }

        /*
        |--------------------------------------------------------------------------
        | Filter : Age Group
        |--------------------------------------------------------------------------
        */

        if (request('age_group')) {

            switch (request('age_group')) {

                case 'elderly':

                    $query->whereRaw("
                        TIMESTAMPDIFF(YEAR,birth_date,CURDATE()) >= 60
                    ");

                    break;

                case 'child':

                    $query->whereRaw("
                        TIMESTAMPDIFF(YEAR,birth_date,CURDATE()) <=12
                    ");

                    break;

                case 'working':

                    $query->whereRaw("
                        TIMESTAMPDIFF(YEAR,birth_date,CURDATE()) BETWEEN 13 AND 59
                    ");

                    break;

            }

        }

        /*
        |--------------------------------------------------------------------------
        | Filter : Welfare
        |--------------------------------------------------------------------------
        */

        if (request('benefit')) {

            switch (request('benefit')) {

                case 'elderly':

                    $query->whereHas('welfareBenefits',function($q){

                        $q->whereHas('benefitType',function($qq){

                            $qq->where('code','ELDERLY_ALLOWANCE');

                        });

                    });

                    break;

                case 'disabled':

                    $query->whereHas('welfareBenefits',function($q){

                        $q->whereHas('benefitType',function($qq){

                            $qq->where('code','DISABILITY_ALLOWANCE');

                        });

                    });

                    break;
                
                case 'disability_profile':

                    $query->whereHas('welfareProfile', function ($q) {
                        $q->where('is_disabled', true);
                    });

                    break;

            }

        }

        /*
        |--------------------------------------------------------------------------
        | Filter : Health
        |--------------------------------------------------------------------------
        */

        if(request('health')){

            switch(request('health')){

                case 'bedridden':

                    $query->whereHas('healthProfile',function($q){

                        $q->where('is_bedridden',true);

                    });

                    break;

                case 'homebound':

                    $query->whereHas('healthProfile',function($q){

                        $q->where('is_homebound',true);

                    });

                    break;

            }

        }

        $summaryQuery = clone $query;

        $totalCitizens = (clone $summaryQuery)->count();

        $totalMale = (clone $summaryQuery)
            ->where('gender', 'ชาย')
            ->count();

        $totalFemale = (clone $summaryQuery)
            ->where('gender', 'หญิง')
            ->count();

        $totalHouseholds = (clone $summaryQuery)
            ->whereNotNull('household_id')
            ->distinct()
            ->count('household_id');

        $citizens = $query
            ->with('household')
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();

        $pageTitle = 'ทะเบียนประชาชน';

        if (request('moo')) {
            $pageTitle .= ' — หมู่ ' . request('moo');
        } elseif (request('gender')) {
            $pageTitle .= ' — ประชากร' . request('gender');
        } elseif (request('age_group') === 'elderly') {
            $pageTitle .= ' — ผู้สูงอายุ';
        } elseif (request('benefit') === 'elderly') {
            $pageTitle .= ' — ผู้รับเบี้ยผู้สูงอายุ';
        } elseif (request('benefit') === 'disability_profile') {
            $pageTitle .= ' — ผู้พิการ';
        } elseif (request('health') === 'bedridden') {
            $pageTitle .= ' — ผู้ป่วยติดเตียง';
        } elseif (request('health') === 'homebound') {
            $pageTitle .= ' — ผู้ป่วยติดบ้าน';
        }

        return view('citizens.index', compact(
            'citizens',
            'totalCitizens',
            'totalMale',
            'totalFemale',
            'totalHouseholds',
            'pageTitle'
        ));
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
            'welfareBenefits.benefitType',
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