<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\House; use App\Services\AuditLogger; use Illuminate\Http\Request;
class ReviewController extends Controller {
 public function index(){return view('admin.review',['houses'=>House::with('region')->where('status','submitted')->latest()->paginate(20)]);}
 public function approve(Request $r,House $house){$old=$house->toArray();$house->update(['status'=>'verified','is_public'=>true,'updated_by'=>auth()->id()]);if($house->latestAssessment)$house->latestAssessment->update(['status'=>'verified']);AuditLogger::log($r->user(),'VERIFY','House',$house->id,$old,$house->fresh()->toArray());return back()->with('ok','Data disetujui dan dipublikasikan.');}
 public function revision(Request $r,House $house){$old=$house->toArray();$house->update(['status'=>'revision','is_public'=>false,'updated_by'=>auth()->id()]);AuditLogger::log($r->user(),'REVISION','House',$house->id,$old,$house->fresh()->toArray());return back()->with('ok','Data dikembalikan ke Surveyor untuk revisi.');}
}
