<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // //$user adalah user yang login
        // //teacher diambil dari parameter controller TeacherController
        // Gate::define('teacher', function ($user, $teacher) {
        //     // dd($user->roles->first()->name);
        //     return $user->id == $teacher->user_id || $user->roles->first()->name == 'admin';
        // });

        // //student diambil dari parameter controller StudentController
        // Gate::define('student', function ($user, $student) {
        //     // dd($user->role_id);
        //     return $user->id == $student->user_id || $user->role_id == 1;
        // });
    }
}
