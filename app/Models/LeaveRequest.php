<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'start_date', 'end_date', 'reason', 'other_reason', 'status', 'leave_type', 'supervisor_approval',
    'admin_approval',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterByLeaveType($query, $leaveType)
    {
        if ($leaveType !== 'all') {
            $query->where('leave_type', $leaveType);
        }
    }
}
