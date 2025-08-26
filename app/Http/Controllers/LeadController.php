<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Response;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::query();

        if ($request->has('min_score')) {
            $query->where('score', '>=', $request->min_score);
        }

        $leads = $query->orderBy('score', 'desc')->paginate(10);

        return view('leads.index', compact('leads'));
    }

    // Simpan lead baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:leads,email',
        ]);

        Lead::create($request->all());
        return redirect()->back()->with('success', 'Lead added!');
    }

    // Export CSV
    public function exportCsv()
    {
        $leads = Lead::all();
        $csvHeader = ['Name', 'Email', 'Company', 'Position', 'Score'];
        $filename = "leads.csv";

        $handle = fopen($filename, 'w');
        fputcsv($handle, $csvHeader);

        foreach ($leads as $lead) {
            fputcsv($handle, [$lead->name, $lead->email, $lead->company, $lead->position, $lead->score]);
        }

        fclose($handle);

        return Response::download($filename);
    }
}
