<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\BusinessGroup;
use App\Models\BusinessType;
use Illuminate\View\View;

class ShopLicenseDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'groups' => BusinessGroup::count(),
            'categories' => BusinessCategory::count(),
            'types' => BusinessType::count(),

            'active_groups' => BusinessGroup::where('is_active', true)->count(),
            'active_categories' => BusinessCategory::where('is_active', true)->count(),
            'active_types' => BusinessType::where('is_active', true)->count(),

            'inactive_types' => BusinessType::where('is_active', false)->count(),
        ];

        return view(
            'shop-license.dashboard',
            compact('stats')
        );
    }
}