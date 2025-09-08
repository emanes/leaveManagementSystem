<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;
    protected $table = 'leave_requests';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'employee_id',
        'leave_type',
        'leave_from',
        'leave_to',
        'reason',
        'status',
        'comment',
    ];

    // Define the relationship with the Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
