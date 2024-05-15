<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configurePermissions();

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('username', $request->username)->first();
    
                    if ($user && Hash::check($request->password, $user->password)) {
                        if($user->role === 'admin' || $user->role === 'BP' || $user->role === 'superadmin') {
                            if ($user->status === 'active') {
                                return $user;
                            } else {
                                // view('error-page.auth-blockAcc');
                                dd('authentication fiale', 'your not access to system');
                            }
                        } else {
                            dd('authentication fiale');
                        }
                    }
        });


        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
