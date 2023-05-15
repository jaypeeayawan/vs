<?php
use App\Http\Controllers\AuthRedirects;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\VotersPortalComponent;
use App\Http\Livewire\VotersRegistrationComponent;
use App\Http\Livewire\VotingFormComponent;
use App\Http\Livewire\LoginComponent;

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminPositionsComponent;
use App\Http\Livewire\Admin\AdminElectionFormsComponent;
use App\Http\Livewire\Admin\AdminCandidatesComponent;
use App\Http\Livewire\Admin\AdminVotersComponent;
use App\Http\Livewire\Admin\AdminUsersComponent;
use App\Http\Livewire\Admin\AdminResultsComponent;

use App\Http\Livewire\User\UserDashboardComponent;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthRedirects::class, 'redirecTo']);
Route::get('home', HomeComponent::class)->name('home');
Route::get('voters.portal', VotersPortalComponent::class)->name('voters.portal');
Route::get('voters.registration', VotersRegistrationComponent::class)->name('voters.registration');
Route::get('voting.form/{votersid}', VotingFormComponent::class)->name('voting.form');

// for user routes
Route::middleware(['auth:sanctum', 'verified', 'authuser'])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});

// for admin routes
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/positions', AdminPositionsComponent::class)->name('admin.positions');
    Route::get('/admin/electionforms', AdminElectionFormsComponent::class)->name('admin.electionforms');
    Route::get('/admin/candidates', AdminCandidatesComponent::class)->name('admin.candidates');
    Route::get('/admin/voters', AdminVotersComponent::class)->name('admin.voters');
    Route::get('/admin/results', AdminResultsComponent::class)->name('admin.results');
    Route::get('/admin/users', AdminUsersComponent::class)->name('admin.users');
});
