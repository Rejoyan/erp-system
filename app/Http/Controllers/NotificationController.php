<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Display a listing of the notifications
    public function index()
    {
        $notifications = Notification::with('user')->latest()->paginate(10); // Paginate and order by latest
        return view('notifications.index', compact('notifications'));
    }

    // Show the form for creating a new notification
    public function create()
    {
        $users = User::all();
        $notificationTypes = ['email', 'sms', 'in-app']; // Types of notifications
        return view('notifications.create', compact('users', 'notificationTypes'));
    }

    // Store a newly created notification in storage
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'type' => 'required|in:email,sms,in-app', // Validate type
        ]);

        $notification = Notification::create([
            'user_id' => $request->user_id,
            'message' => $request->message,
            'type' => $request->type,
            'is_read' => false,
        ]);

        $this->sendNotification($notification);

        return redirect()->route('notifications.index')->with('success', 'Notification created and sent successfully.');
    }

    // Mark the specified notification as read
    public function markAsRead(Notification $notification)
    {
        $notification->update(['is_read' => true]);
        return redirect()->route('notifications.index')->with('success', 'Notification marked as read.');
    }

    // Remove the specified notification from storage
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }

    // Send notification to users based on type and preferences
    protected function sendNotification($notification)
    {
        $user = $notification->user;

        switch ($notification->type) {
            case 'email':
                if ($user->preferences['email_notifications'] ?? false) {
                    \Mail::to($user->email)->send(new \App\Mail\NotificationMail($notification));
                }
                break;

            case 'sms':
                if ($user->preferences['sms_notifications'] ?? false) {
                    // Use a service like Twilio to send SMS
                    // Twilio::message($user->phone, $notification->message);
                }
                break;

            case 'in-app':
                // In-app notifications are already stored in the database
                break;
        }
    }

    // Manage user notification preferences
    public function preferences(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
        ]);

        $user->preferences = array_merge($user->preferences ?? [], $request->only(['email_notifications', 'sms_notifications']));
        $user->save();

        return redirect()->back()->with('success', 'Preferences updated successfully.');
    }
}
