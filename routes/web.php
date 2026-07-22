<?php

use App\Livewire\AddSports;
use App\Livewire\ApproveRegistration;
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
use App\Livewire\RegisterSport;
use App\Livewire\RegistrationStatus;
use App\Livewire\AthleteListForEachSport;
use App\Livewire\AddContingent;
use App\Livewire\Listcontingents;
use App\Livewire\EditContingent;
use App\Livewire\ListApprovedRegistrations;
use App\Livewire\AddAthleteToContinget;
use App\Livewire\ViewEachRegistration;
use App\Livewire\EditEachRegistration;
use App\Livewire\DetailsEachContingent;
use App\Livewire\AssignMatchParticipants;


//use App\Models\MatchRecord;

Route::middleware(['auth'])->group(function () {
    Route::impersonate();
});

Route::view('/', 'welcome');

Route::get('dashboard', function () {
    $users = \App\Models\User::where('id', '!=', auth()->id())->get();
    return view('dashboard', compact('users'));
})
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

    Route::get('/registerSport', RegisterSport::class)->name('registerSport');

    Route::get('/approveRegistration', ApproveRegistration::class)->name('approveRegistration');
    Route::get('/registrationStatus', RegistrationStatus::class)->name('registrationStatus');
    Route::get('athleteListForEachSport/{sport}', AthleteListForEachSport::class)->name('athleteListForEachSport');
    Route::get('/addContingent', AddContingent::class)->name('addContingent');
    Route::get('/listcontingents', Listcontingents::class)->name('listContingents');
    Route::get('/editcontingent/{contingent}', EditContingent::class)->name('editContingent');
    Route::get('/listApprovedRegistrations', ListApprovedRegistrations::class)->name('listApprovedRegistrations');
    Route::get('/addToContingent/{registration}', AddAthleteToContinget::class)->name('addToContingent');
    Route::get('/viewRegistration/{registration}', ViewEachRegistration::class)->name('viewRegistration');
    Route::get('/editRegistration/{registration}', EditEachRegistration::class)->name('editRegistration');
    Route::get('/detailsEachContingent/{contingent}', DetailsEachContingent::class)->name('detailsEachContingent');
    Route::get('/assignMatchParticipants', AssignMatchParticipants::class)->name('assignMatchParticipants');

});
// Protected management route for PICs only
//Route::middleware(['auth', 'role:PIC|Admin'])->group(function () {
    //Route::get('/manage/scores/{match}', PicScoreManager::class)->name('scores.manage');
//});

require __DIR__.'/auth.php';
