<?php

namespace App\Http\Controllers;

use App\Models\ServiceCase;
use App\Models\Citizen;
use App\Http\Requests\StoreServiceCaseRequest;
use App\Models\ServiceCaseTimeline;


class ServiceCaseController extends Controller
{
    public function index()
    {
        $cases = ServiceCase::with('citizen')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('service_cases.index', compact('cases'));
    }

    public function create()
    {
        $citizens = Citizen::orderBy('first_name')
            ->get();

        return view(
            'service_cases.create',
            compact('citizens')
        );
    }

    public function store(StoreServiceCaseRequest $request)
    {
        $case = ServiceCase::create([
            'citizen_id' => $request->citizen_id,
            'module' => $request->module,
            'case_type' => $request->case_type,
            'status' => 'open',
            'priority' => $request->priority,
            'opened_at' => $request->opened_at,
            'created_by' => auth()->id(),
            'remark' => $request->remark,
        ]);

        ServiceCaseTimeline::create([
            'service_case_id' => $case->id,
            'action' => 'open_case',
            'description' => 'เปิดเคสใหม่',
            'user_id' => auth()->id(),
            'action_at' => now(),
        ]);

        return redirect()
            ->route('service-cases.index')
            ->with('success', 'เปิดเคสใหม่เรียบร้อยแล้ว');
    }

    public function show(ServiceCase $serviceCase)
    {
        $serviceCase->load([
            'citizen',
            'timelines.user',
            'assignedUser',
            'creator',
        ]);

        return view('service_cases.show', compact('serviceCase'));
    }

    public function createForCitizen(Citizen $citizen)
    {
        return view('service_cases.create_for_citizen', compact('citizen'));
    }

    public function updateStatus(ServiceCase $serviceCase)
    {
        request()->validate([
            'status' => ['required', 'in:open,assessing,approved,processing,follow_up,closed,cancelled'],
        ]);

        $oldStatus = $serviceCase->status;

        $serviceCase->update([
            'status' => request('status'),
            'closed_at' => request('status') === 'closed' ? now() : null,
        ]);

        ServiceCaseTimeline::create([
            'service_case_id' => $serviceCase->id,
            'action' => 'status_changed',
            'description' => 'เปลี่ยนสถานะจาก ' . $oldStatus . ' เป็น ' . request('status'),
            'user_id' => auth()->id(),
            'action_at' => now(),
        ]);

        return redirect()
            ->route('service-cases.show', $serviceCase)
            ->with('success', 'อัปเดตสถานะเคสเรียบร้อยแล้ว');
    }

    public function storeTimeline(ServiceCase $serviceCase)
    {
        request()->validate([
            'action' => ['required', 'max:100'],
            'description' => ['nullable'],
            'action_at' => ['nullable', 'date'],
        ]);

        ServiceCaseTimeline::create([
            'service_case_id' => $serviceCase->id,
            'action' => request('action'),
            'description' => request('description'),
            'user_id' => auth()->id(),
            'action_at' => request('action_at') ?? now(),
        ]);

        return redirect()
            ->route('service-cases.show', $serviceCase)
            ->with('success', 'บันทึกกิจกรรมเรียบร้อยแล้ว');
    }
}