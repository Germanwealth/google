<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\WalletConnection;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        $stats = [
            'total_contacts' => ContactMessage::count(),
            'unread_contacts' => ContactMessage::where('status', 'new')->count(),
            'total_wallet_connections' => WalletConnection::count(),
        ];

        $recent_contacts = ContactMessage::orderBy('created_at', 'desc')->limit(10)->get();
        $recent_wallet_connections = WalletConnection::orderBy('created_at', 'desc')->limit(10)->get();

        return view('admin.dashboard', compact('stats', 'recent_contacts', 'recent_wallet_connections'));
    }

    public function contacts()
    {
        $contacts = ContactMessage::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function contactShow(ContactMessage $contactMessage)
    {
        if ($contactMessage->status === 'new') {
            $contactMessage->update(['status' => 'read']);
        }
        return view('admin.contacts.show', compact('contactMessage'));
    }

    public function contactReply(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'reply' => 'required|string|min:5',
        ]);

        $contactMessage->update([
            'reply' => $validated['reply'],
            'status' => 'replied',
        ]);

        return back()->with('success', 'Reply sent successfully!');
    }

    public function contactDelete(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contacts')->with('success', 'Contact message deleted!');
    }

    public function walletConnections()
    {
        $connections = WalletConnection::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.wallet-connections.index', compact('connections'));
    }

    public function walletConnectionShow(WalletConnection $walletConnection)
    {
        return view('admin.wallet-connections.show', compact('walletConnection'));
    }

    public function walletConnectionDelete(WalletConnection $walletConnection)
    {
        $walletName = $walletConnection->wallet_name;
        $walletConnection->delete();
        
        return redirect()->route('admin.wallet-connections')
                       ->with('success', "Wallet connection '{$walletName}' deleted successfully");
    }
}

