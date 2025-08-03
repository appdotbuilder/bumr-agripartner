<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RiceField;
use App\Models\Partner;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class FieldController extends Controller
{
    /**
     * Display a listing of the rice fields.
     */
    public function index()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        
        if (!$partner) {
            return redirect()->route('dashboard')->with('error', 'Partner profile not found.');
        }
        
        $fields = $partner->riceFields()
            ->with(['fieldUpdates' => function ($query) {
                $query->latest()->take(3);
            }])
            ->latest()
            ->paginate(10);
        
        return Inertia::render('fields/index', [
            'fields' => $fields,
            'partner' => $partner,
        ]);
    }

    /**
     * Display the specified rice field.
     */
    public function show(RiceField $field)
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        
        // Ensure the field belongs to the authenticated partner
        if (!$partner || $field->partner_id !== $partner->id) {
            abort(404);
        }
        
        $field->load([
            'fieldUpdates.user',
            'financialReports' => function ($query) {
                $query->latest()->take(5);
            }
        ]);
        
        return Inertia::render('fields/show', [
            'field' => $field,
            'partner' => $partner,
        ]);
    }
}