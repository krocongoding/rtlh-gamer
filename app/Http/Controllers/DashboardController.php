<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\RtlhAssessment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalHouses = House::count();

        $draftHouses = House::where('status', 'draft')->count();

        $completedHouses = House::where('status', 'completed')->count();

        $verifiedHouses = House::where('status', 'verified')->count();

        $publicHouses = House::where('is_public', true)->count();

        $totalAssessments = RtlhAssessment::count();

        $housesByStatus = House::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        $housesByYear = House::query()
            ->selectRaw('survey_year, COUNT(*) as total')
            ->whereNotNull('survey_year')
            ->groupBy('survey_year')
            ->orderBy('survey_year')
            ->get();

        return view('dashboard', compact(
            'totalHouses',
            'draftHouses',
            'completedHouses',
            'verifiedHouses',
            'publicHouses',
            'totalAssessments',
            'housesByStatus',
            'housesByYear'
        ));
    }
}