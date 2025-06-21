<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Models\DocumentationTicket;
use App\Models\Ticket;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    //Routes for everyone auth
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::resource('tickets', TicketController::class);
    
    //Only Agents
    Route::middleware('role:agent')->group(function () {
        
        Route::get('/agent/panel', [TicketController::class, 'index'])->name('agent.panel');
        Route::get('/agent/tickets/{id}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
        Route::put('/agent/tickets/{id}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
        Route::get('/agent/notifications', [NotificationController::class, 'agentNotification'])->name('agent.notifications');
        Route::get('/agent/panel/ticket/document/{id}', [DocumentController::class, 'index'])->name('agent.tickets.document');

        Route::get('/agent/panel/ticket/notification/{id}', [Ticket::class, 'agentCustomTicketNotification'])->name('agent.tickets.notificaton.custom');


        //Route::get('/agent/panel/ticket/document/{id}', [TicketController::class, 'uploadstatus'])->name('agent.tickets.status');
        /*
        Route::get('notifications_users', [NotificationController::class, 'index']);
        Route::get('notifications_agent_ticket/{$id}', [NotificationController::class, 'index']);*/
    });

    //Only Users
    Route::middleware('role:user')->group(function () {
        Route::get('/user/panel', [TicketController::class, 'index'])->name('user.panel');

        Route::get('/user/notifications', [NotificationController::class, 'userNotification'])->name('user.notifications');
        Route::get('/user/panel/ticket/notification/{id}', [Ticket::class, 'userCustomTicketNotification'])->name('user.tickets.notificaton.custom');
        Route::get('/user/panel/newticket', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/user/panel/newticket', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/user/panel/newticket/ticketsave', [TicketController::class, 'store'])->name('tickets.save');
        Route::get('/user/panel/delete_tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');

        Route::get('/user/panel/ticket/document/{id}', [DocumentController::class, 'index'])->name('tickets.document');
        Route::get('/user/panel/ticket/document/{id}/new', [DocumentController::class, 'newDocument'])->name('document.new');
        Route::post('/user/panel/ticket/document/{id}/save', [DocumentController::class, 'store'])->name('document.save');


        /*
        Route::post('/tickets/{id}/upload', [DocumentationTicket::class, 'store']);
        Route::get('notifications_users', [NotificationController::class, 'index']);
        Route::get('notifications_users_ticket/{$id}', [NotificationController::class, 'index']);*/
    });

    //Only Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/panel', [TicketController::class, 'index'])->name('admin.panel');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        //Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');
    });
});

require __DIR__.'/auth.php';
