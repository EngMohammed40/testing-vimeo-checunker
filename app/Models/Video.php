<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    use HasFactory;


    public function isJobCompleted(){
        return !DB::table('jobs')->where('id',$this->job_id)->exists();
    }
}
