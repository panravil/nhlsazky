<?php

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

use App\Http\Controllers\Admin\DashboardController;
Auth::routes(['verify' => true]);

Route::get('/nova-sezona', 'HomeController@countdown')->name('nova-sezona');
Route::get('/countdown', 'HomeController@countdown')->name('nova-sezona');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/o-mne', 'HomeController@about')->name('about');
    Route::get('/test', 'HomeController@test')->name('test');
    Route::get('/odhlasit', 'Auth\LoginController@logout')->name('logout');
    Route::get('/zaregistrovat', 'Auth\RegisterController@showRegistrationForm')->name('showRegistrationForm');
    Route::post('/notifikace', 'UserController@updateNotification')->name('updateNotification')->middleware('auth');
    Route::post('/newsletter', 'UserController@updateNewsletter ')->name('updateNewsletter')->middleware('auth');
    Route::get('/muj-ucet', 'HomeController@account')->name('account')->middleware('auth');
    Route::get('/muj-ucet/upravit', 'UserController@edit')->name('accountEdit')->middleware('auth');
    Route::patch('/muj-ucet/upravit', 'UserController@update')->name('accountEditEmail')->middleware('auth');
    Route::post('/muj-ucet', 'HomeController@accountUpdate')->name('accountUpdate')->middleware('auth');
    Route::get('/premium', 'HomeController@premium')->name('premium');
    Route::get('/premium/tiket/{id}/upvote', 'TicketsController@upvote')->name('upvote');
    Route::get('/premium/tiket/{id}/downvote', 'TicketsController@downvote')->name('downvote');

    Route::get('/live-sazky', 'LiveController@index')->name('live')->middleware('auth');
    Route::post('/live-sazky', 'LiveController@chat')->name('chat')->middleware('auth');
    Route::post('/live-sazky/chat', 'LiveController@chatPost')->name('chatPost')->middleware('auth');
    Route::post('/live-sazky/tikety', 'LiveController@liveTickets')->name('liveTickets')->middleware('auth');
    Route::get('/proxy', 'HomeController@proxy')->name('proxy');
    Route::resource('/soutez', 'CompetitionController', ['except' => ['update', 'edit', 'destroy']]);
    Route::get('/soutez/tip/{match}/{tip}', 'CompetitionController@contestTip')->name('contestTip');
    Route::get('/o-mne', 'HomeController@about')->name('about');
    Route::get('/statistiky', 'StatsController@globalStats')->name('statsGlobal');
    Route::get('/statistiky/{typ}', 'StatsController@packageStats')->name('statsPackage');
    Route::get('/stream/{match}', 'HomeController@stream')->name('matchStream');
    Route::get('/statistiky/{typ}/{sezona}/{obdobi}', 'StatsController@detailStats')->name('statsDetail');
    Route::get('/kontakt', 'HomeController@contact')->name('contact');
    Route::post('/kontakt', 'HomeController@sendContact')->name('sendContact');
    Route::get('/faq', 'HomeController@faq')->name('faq');
    Route::get('/obchodni-podminky', 'HomeController@terms')->name('terms');
    Route::get('/slovnik-pojmu', 'HomeController@dictionary')->name('dictionary');
});
Route::get('/cron/jobs/checknhl', 'cron\CronController@checknhl')->name('cron.checkGames');
Route::get('/cron/jobs/evaluateGames', 'cron\CronController@evaluateGames')->name('cron.evaluateGames');
Route::get('/cron/jobs/evaluateGames', 'cron\CronController@evaluateGames')->name('cron.evaluateGames');
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => '/admin', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/uzivatele', 'Admin\UsersController', ['except' => ['store', 'create']]);
    Route::resource('/tymy', 'Admin\TeamsController', ['except' => ['store', 'create']]);
    Route::resource('/zapasy', 'Admin\MatchesController');
    Route::patch('/zapasy/{match}/winner', 'Admin\MatchesController@setWinner')->name('zapasy.setWinner');
    Route::patch('/zapasy/{id}/restore', 'Admin\MatchesController@restore')->name('zapasy.restore');
    Route::resource('/tikety', 'Admin\TicketsController');
    Route::post('/tikety/{ticket}/resolve', 'Admin\TicketsController@setStatus')->name('setStatus');
    Route::get('/live/zapnout', 'Admin\SettingsController@enableLive')->name('enableLive');
    Route::get('/live/vypnout', 'Admin\SettingsController@disableLive')->name('disableLive');
    Route::get('/chat/zapnout', 'Admin\SettingsController@enableChat')->name('enableChat');
    Route::get('/chat/vypnout', 'Admin\SettingsController@disableChat')->name('disableChat');
    Route::get('/live/zobrazit', 'Admin\SettingsController@showLive')->name('showLive');
    Route::get('/live/schovat', 'Admin\SettingsController@hideLive')->name('hideLive');
    Route::post('/live-tikety/delete', 'Admin\SettingsController@liveDelete')->name('liveDelete');
    Route::post('/live-tikety/update', 'Admin\SettingsController@liveUpdate')->name('liveUpdate');
    Route::post('/live-tikety/store', 'Admin\SettingsController@liveStore')->name('liveStore');
    Route::post('/live-chat/clear', 'Admin\SettingsController@chatClear')->name('chatClear');
    Route::get('/notifikovat', 'Admin\TicketsController@sendNotifications')->name('sendNotifications');
    Route::resource('/balicky', 'Admin\PackagesController', ['except' => ['store', 'create']]);
    Route::resource('/tarify', 'Admin\TariffsController');
    Route::resource('/transakce', 'Admin\TransactionsController');
    Route::resource('/zpravy', 'Admin\MessagesController', ['except' => ['store', 'create']]);
    Route::resource('/texty', 'Admin\SectionsController', ['except' => ['store', 'create']]);
    Route::resource('/recenze', 'Admin\ReviewsController');
    Route::resource('/faq', 'Admin\FAQController');
    Route::resource('/blog', 'Admin\BlogController');
    Route::resource('/udalosti', 'Admin\EventsController');
    Route::resource('/redirects', 'Admin\RedirectsController');
    Route::get('/soutez/', 'Admin\ContestController@index')->name('soutez');
    Route::post('/soutez/vyhodnotit', 'Admin\ContestController@endContest')->name('soutez.endContest');
    Route::resource('/emails', 'Admin\MailsController');
    Route::resource('/predplatne', 'Admin\SubscriptionsControler');
    Route::fallback('Admin\DashboardController@notFound');
});

Route::get('/phpinfo', function () {
    echo phpinfo();
});

Route::get('/platba/{tarif}/{curr}', 'HomeController@platba')->name('platba');
Route::get('/platba/callback', 'Admin\TransactionsController@callback')->name('callbackPayment');
Route::post('/platba/callback', 'Admin\TransactionsController@callbackPost')->name('callbackPaymentPost');


Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/udalost/{name}', 'HomeController@event')->name('page');
    Route::get('/akce/{name}', 'HomeController@redirect')->name('redirect');
});
