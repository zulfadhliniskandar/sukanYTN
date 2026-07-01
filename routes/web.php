<?php

use App\Livewire\AddSports;
use App\Livewire\EditSport;
use App\Livewire\ListAvailableVenue;
use App\Livewire\MatchList;
use Illuminate\Support\Facades\Route;
use App\Livewire\PublicScoreboard;
use App\Livewire\PicScoreManager;
use App\Livewire\AddVenue;
use App\Livewire\AvailabelSports;
use App\Livewire\CreateMatch;
use App\Livewire\AssignPIC;
use App\Livewire\ListPIC;
use App\Livewire\EditVenue;

//use App\Models\MatchRecord;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/scores/{match}', PublicScoreboard::class)->name('scores.show');
    Route::get('/scores', MatchList::class)->name('listMatch');
    Route::get('/addvenue', AddVenue::class)->name('addVenue');
    Route::get('/createsport', AddSports::class)->name('createSports');
    Route::get('/listvenue', ListAvailableVenue::class)->name('listVenue');
    Route::get('/creatematch', CreateMatch::class)->name('createMatch');
    Route::get('/listsport', AvailabelSports::class)->name('listSport');
    Route::get('/assignPIC/{sport}', AssignPIC::class)->name('assignPIC');
    Route::get('/listPIC/{sport}', ListPIC::class)->name('listPIC');

    Route::get('/editvenue/{venue}', EditVenue::class)->name('editVenue');
    Route::get('/editsport/{sport}', EditSport::class)->name('editSport');

    Route::get('/manage/scores/{match}', PicScoreManager::class)->name('scores.manage');
});
// Protected management route for PICs only
//Route::middleware(['auth', 'role:PIC|Admin'])->group(function () {
    //Route::get('/manage/scores/{match}', PicScoreManager::class)->name('scores.manage');
//});

require __DIR__.'/auth.php';
