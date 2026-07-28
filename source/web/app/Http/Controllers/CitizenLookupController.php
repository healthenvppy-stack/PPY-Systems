<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CitizenLookupController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'citizen_id' => ['required', 'digits:13'],
        ]);

        $citizen = Citizen::query()
            ->with('title')
            ->where('cid', $validated['citizen_id'])
            ->first();

        if (!$citizen) {
            return response()->json([
                'found' => false,
                'message' => 'ไม่พบข้อมูลประชาชน',
            ], 404);
        }

        return response()->json([
            'found' => true,
            'citizen' => [
                'id' => $citizen->id,
                'citizen_id' => $citizen->cid,
                'prefix' => $citizen->title?->name ?? '',
                'first_name' => $citizen->first_name ?? '',
                'last_name' => $citizen->last_name ?? '',
                'phone' => $citizen->phone ?? '',
                'email' => $citizen->email ?? '',
            ],
        ]);
    }
}