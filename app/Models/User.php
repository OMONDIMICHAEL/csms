<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone_number',
        'address',
        // 'admin_code',
        'accountant_id',
        'librarian_id',
        'cook_id',
        'teacher_id',
        'subject',
        'student_id',
        'class',
        'parent_contact',
        'parent_email',
        'parent_id',
        'number_of_children',
        'security_id'
        // 'admin_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function subjectsTaught() {
        return $this->belongsToMany(Subject::class, 'teacher_subjects', 'teacher_id', 'subject_id');
    }
    public function subjectsEnrolled() {
        return $this->belongsToMany(Subject::class, 'student_subjects', 'student_id', 'subject_id');
    }
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'teacher_subjects', 'teacher_id', 'subject_id');
    }
    public function submissions()
    {
      return $this->hasMany(Submission::class, 'student_id');
    }
    // A parent has many children (students)
   public function children()
   {
       return $this->hasMany(User::class, 'parent_contact', 'phone_number');
   }

   // A student belongs to a parent
   public function parent()
   {
       return $this->belongsTo(User::class, 'parent_contact', 'phone_number');
   }
}
