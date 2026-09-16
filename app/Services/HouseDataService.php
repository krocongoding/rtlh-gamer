<?php
namespace App\Services;
use App\Models\House;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class HouseDataService
{
    public function save(House $house, array $data, int $userId, bool $submit=false): House
    {
        return DB::transaction(function() use($house,$data,$userId,$submit){
            $lat=$data['latitude'] ?? null; $lng=$data['longitude'] ?? null;
            unset($data['latitude'],$data['longitude'],$data['assessment_notes']);
            foreach (['foundation','sloof_condition_id','column_condition_id','beam_condition_id'] as $k) $structure[$k]=$data[$k]??null;
            foreach (['floor_material_id'=>'material_id','floor_condition_id'=>'condition_id'] as $from=>$to) $floor[$to]=$data[$from]??null;
            foreach (['wall_material_id'=>'material_id','wall_condition_id'=>'condition_id'] as $from=>$to) $wall[$to]=$data[$from]??null;
            foreach (['roof_frame_condition_id'=>'frame_condition_id','roof_material_id'=>'material_id','roof_condition_id'=>'condition_id'] as $from=>$to) $roof[$to]=$data[$from]??null;
            foreach (['water_source_id','toilet_available','toilet_type_id','fecal_disposal_type_id','water_fecal_distance'] as $k) $san[$k]=$data[$k]??null;
            foreach (['light_opening','ventilation','lighting_source_id'] as $k) $util[$k]=$data[$k]??null;
            foreach (['floor_material_id','floor_condition_id','wall_material_id','wall_condition_id','roof_frame_condition_id','roof_material_id','roof_condition_id','water_source_id','toilet_available','toilet_type_id','fecal_disposal_type_id','water_fecal_distance','light_opening','ventilation','lighting_source_id'] as $k) unset($data[$k]);
            $data['updated_by']=$userId;
            if ($submit) { $data['status']='submitted'; $data['is_public']=false; }
            $house->fill($data); $house->save();
            $house->structure()->updateOrCreate(['house_id'=>$house->id],$structure);
            $house->floor()->updateOrCreate(['house_id'=>$house->id],$floor);
            $house->wall()->updateOrCreate(['house_id'=>$house->id],$wall);
            $house->ceiling()->updateOrCreate(['house_id'=>$house->id],['condition_id'=>$data['ceiling_condition_id']??null]);
            $house->roof()->updateOrCreate(['house_id'=>$house->id],$roof);
            $house->sanitation()->updateOrCreate(['house_id'=>$house->id],$san);
            $house->utility()->updateOrCreate(['house_id'=>$house->id],$util);
            if ($lat!==null && $lng!==null) DB::statement('UPDATE houses SET location = ST_SetSRID(ST_MakePoint(?, ?),4326) WHERE id = ?',[$lng,$lat,$house->id]);
            if ($submit) {
                $assessment=$house->assessments()->firstOrCreate(['assessment_year'=>$house->survey_year],['assessment_date'=>now(),'assessor_id'=>$userId,'status'=>'submitted','notes'=>$data['assessment_notes']??null]);
                $assessment->update(['assessment_date'=>now(),'assessor_id'=>$userId,'status'=>'submitted']);
            }
            return $house->fresh();
        });
    }
    public function storePhotos(House $house, array $files, int $userId): void
    {
        $map=['photo_front'=>'front','photo_angle'=>'angle_45','photo_side'=>'side','photo_back'=>'back','photo_family_room'=>'family_room','photo_bathroom'=>'bathroom'];
        foreach($map as $field=>$type){ if(empty($files[$field])) continue; $path=$files[$field]->store('rtlh/'.$house->house_code,'public'); $house->photos()->create(['type'=>$type,'path'=>$path,'disk'=>'public','uploaded_by'=>$userId]); }
    }
}
