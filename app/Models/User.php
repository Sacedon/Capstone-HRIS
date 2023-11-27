<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Log;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'surname',
        'first_name',
        'middle_name',
        'email',
        'password',
        'role',
        'gender',
        'date_of_birth',
        'department_id',
        'profile_picture',
        'civil_status',
        'height',
        'weight',
        'blood_type',
        'sss_id_no',
        'pag_ibig_id_no',
        'philhealth_no',
        'tin_no',
        'mdc_id',
        'place_of_birth',
        'residential_house_no',
        'residential_street',
        'residential_subdivision',
        'residential_barangay',
        'residential_city',
        'residential_province',
        'residential_zip_code',
        'permanent_house_no',
        'permanent_street',
        'permanent_subdivision',
        'permanent_barangay',
        'permanent_city',
        'permanent_province',
        'permanent_zip_code',
        'telephone_number',
        'mobile_number',
        'messenger_account',
        'spouse_surname',
        'spouse_first_name',
        'spouse_name_extension',
        'spouse_middle_name',
        'spouse_occupation',
        'spouse_employer',
        'spouse_business_address',
        'spouse_telephone',
        'father_surname',
        'father_first_name',
        'father_name_extension',
        'father_middle_name',
        'mother_maiden_surname',
        'mother_first_name',
        'mother_middle_name',
        'elementary_school',
        'elementary_degree',
        'elementary_attendance_from',
        'elementary_attendance_to',
        'elementary_highest_level',
        'elementary_year_graduated',
        'elementary_honors',
        'secondary_school',
        'secondary_degree',
        'secondary_attendance_from',
        'secondary_attendance_to',
        'secondary_highest_level',
        'secondary_year_graduated',
        'secondary_honors',
        'vocational_school',
        'vocational_degree',
        'vocational_attendance_from',
        'vocational_attendance_to',
        'vocational_highest_level',
        'vocational_year_graduated',
        'vocational_honors',
        'college_school',
        'college_degree',
        'college_attendance_from',
        'college_attendance_to',
        'college_highest_level',
        'college_year_graduated',
        'college_honors',
        'graduate_school',
        'graduate_degree',
        'graduate_attendance_from',
        'graduate_attendance_to',
        'graduate_highest_level',
        'graduate_year_graduated',
        'graduate_honors',
        'signature',
        'date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function department()
{
    return $this->belongsTo(Department::class);
}

public function hasEvaluated($evaluator)
    {
        return $this->evaluations()
            ->where('evaluator_id', $evaluator->id)
            ->exists();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'user_id');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }

    public function children()
    {
        return $this->hasMany(Child::class);
    }

    public function leaveRequests()
{
    return $this->hasMany(LeaveRequest::class);
}
}
