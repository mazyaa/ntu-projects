<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(Request $request): View
    {
        $query = ActivityLog::with('user', 'subject')->latest();

        if ($request->filled('action')) {
            $query->where('action', $request->string('action')->toString());
        }

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhere('user_agent', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(15)->withQueryString();

        return view('admin.activity-logs.index', compact('logs'));
    }

    public function show(ActivityLog $activityLog): View
    {
        $activityLog->load('user', 'subject');

        return view('admin.activity-logs.show', compact('activityLog'));
    }
}
