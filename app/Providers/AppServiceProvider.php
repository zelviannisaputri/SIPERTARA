<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Pengajuan;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
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
        View::composer('*', function ($view) {
            $newPengajuanCount = Pengajuan::where('status', 'Menunggu')->count();
            $newKasipemPengajuanCount = Pengajuan::where('status', 'Menunggu Persetujuan Kasipem')->count();
            $unapprovedUserCount = User::where('is_approved', false)->count(); // Tambahkan ini
            
            $view->with([
                'newPengajuanCount' => $newPengajuanCount,
                'newKasipemPengajuanCount' => $newKasipemPengajuanCount,
                'unapprovedUserCount' => $unapprovedUserCount // Tambahkan ini
            ]);
        });
    }
}
