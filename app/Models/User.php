<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Namu\WireChat\Traits\Chatable;
use App\Models\EmployeeSalary;
use App\Models\EmployeeOnboarding;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Chatable;

    const EMPLOYMENT_STATUS_ACTIVE = 'active';
    const EMPLOYMENT_STATUS_INACTIVE = 'inactive';
    const EMPLOYMENT_TYPE_PROBATION = 'probation';
    const EMPLOYMENT_TYPE_REGULAR = 'regular';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
        'email_verified_at',
        'last_login_at',
        'signature',
        'employment_status',
        'employment_type',
        'employment_status_updated_at',
        'employment_type_updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
        'last_login_at',
        'employment_status_updated_at',
        'employment_type_updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'employment_status_updated_at' => 'datetime',
        'employment_type_updated_at' => 'datetime'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            $registrationRole = config('panel.registration_default_role');

            if (!$user->roles()->get()->contains($registrationRole)) {
                $user->roles()->attach($registrationRole);
            }
            
            // Set default employment status and type
            $user->employment_status = 'active';
            $user->employment_type = 'probation';
            $user->save();
        });
    }

    // public function getEmailVerifiedAtAttribute($value)
    // {
    //     return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    // }

    // public function setEmailVerifiedAtAttribute($value)
    // {
    //     $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    // }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->id,
            'password' => 'required|string|min:8|confirmed',
            'employment_status' => 'required|in:active,inactive',
            'employment_type' => 'required|in:probation,regular',
        ];
    }

    public function updateRules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $this->id,
            'password' => 'nullable|string|min:8|confirmed',
            'employment_status' => 'sometimes|required|in:active,inactive',
            'employment_type' => 'sometimes|required|in:probation,regular',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'user_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'user_id');
    }

    public function salaries()
    {
        return $this->hasMany(EmployeeSalary::class, 'employee_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function leaveCredits()
    {
        return $this->hasMany(LeaveCredit::class, 'employee_id');
    }

    public function onboarding()
    {
        return $this->hasOne(EmployeeOnboarding::class);
    }

    public function isActive()
    {
        return $this->employment_status === 'active';
    }

    public function isProbation()
    {
        return $this->employment_type === 'probation';
    }

    public function isRegular()
    {
        return $this->employment_type === 'regular';
    }

    public function setStatus($status)
    {
        $this->employment_status = $status;
        $this->employment_status_updated_at = now();
        return $this->save();
    }

    public function setType($type)
    {
        $this->employment_type = $type;
        $this->employment_type_updated_at = now();
        return $this->save();
    }

    public function scopeActive($query)
    {
        return $query->where('employment_status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('employment_status', 'inactive');
    }

    public function scopeProbation($query)
    {
        return $query->where('employment_type', 'probation');
    }

    public function scopeRegular($query)
    {
        return $query->where('employment_type', 'regular');
    }
}
