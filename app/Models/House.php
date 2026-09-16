<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'region_id',
        'house_code',
        'address',
        'block',
        'rt',
        'rw',
        'area_m2',
        'occupant_count',
        'household_count',
        'survey_year',
        'status',
        'is_public',
        'created_by',
        'updated_by',
        'location',
        'settlement_condition_id',
        'room_function_id',
        'ownership_status_id',
        'land_status_id',
    ];

    protected $appends = [
        'latitude',
        'longitude',
    ];

    protected function casts(): array
    {
        return [
            'area_m2' => 'decimal:2',
            'is_public' => 'boolean',
        ];
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function assessments()
    {
        return $this->hasMany(RtlhAssessment::class);
    }

    public function latestAssessment()
    {
        return $this->hasOne(RtlhAssessment::class)
            ->latestOfMany('assessment_year');
    }

    public function structure()
    {
        return $this->hasOne(HouseStructure::class);
    }

    public function floor()
    {
        return $this->hasOne(HouseFloor::class);
    }

    public function wall()
    {
        return $this->hasOne(HouseWall::class);
    }

    public function roof()
    {
        return $this->hasOne(HouseRoof::class);
    }

    public function sanitation()
    {
        return $this->hasOne(HouseSanitation::class);
    }

    public function utility()
    {
        return $this->hasOne(HouseUtility::class);
    }

    public function occupants()
    {
        return $this->hasMany(HouseOccupant::class);
    }

    public function photos()
    {
        return $this->hasMany(HousePhoto::class);
    }

    public function getLatitudeAttribute()
    {
        return $this->location
            ? ($this->location->coordinates[1] ?? null)
            : null;
    }

    public function getLongitudeAttribute()
    {
        return $this->location
            ? ($this->location->coordinates[0] ?? null)
            : null;
    }
}
