<?php
namespace App\Http\Controllers\Surveyor;
use App\Http\Controllers\Controller;use App\Models\House;
class DashboardController extends Controller {public function index(){ $q=House::where('created_by',auth()->id());return view('surveyor.dashboard',['mine'=>$q->count(),'draft'=>(clone$q)->where('status','draft')->count(),'submitted'=>(clone$q)->where('status','submitted')->count(),'revision'=>(clone$q)->where('status','revision')->count(),'verified'=>(clone$q)->where('status','verified')->count()]);}}
