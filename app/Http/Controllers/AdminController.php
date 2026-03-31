<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\InvestmentPlan;
use App\Models\LoginAttempt;
use App\Models\Transaction;
use App\Models\User;
use App\Models\WalletConnection;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_contacts' => ContactMessage::count(),
            'unread_contacts' => ContactMessage::where('status', 'new')->count(),
            'total_transactions' => Transaction::count(),
            'pending_transactions' => Transaction::where('status', 'pending')->count(),
            'total_investment_plans' => InvestmentPlan::count(),
            'total_wallet_connections' => WalletConnection::count(),
            'total_login_attempts' => LoginAttempt::count(),
        ];

        $recent_contacts = ContactMessage::orderBy('created_at', 'desc')->limit(5)->get();
        $recent_transactions = Transaction::with(['user', 'investmentPlan'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $recent_login_attempts = LoginAttempt::orderBy('created_at', 'desc')->limit(10)->get();

        return view('admin.dashboard', compact('stats', 'recent_contacts', 'recent_transactions', 'recent_login_attempts'));
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

    public function transactions()
    {
        $transactions = Transaction::with(['user', 'investmentPlan'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function transactionShow(Transaction $transaction)
    {
        return view('admin.transactions.show', compact('transaction'));
    }

    public function transactionUpdate(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,failed',
            'notes' => 'nullable|string',
            'transaction_hash' => 'nullable|string|unique:transactions,transaction_hash,' . $transaction->id,
        ]);

        $transaction->update($validated);

        return back()->with('success', 'Transaction updated successfully!');
    }

    public function users()
    {
        $users = User::withCount('transactions')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function userShow(User $user)
    {
        $user->load('transactions.investmentPlan');
        return view('admin.users.show', compact('user'));
    }

    public function investmentPlans()
    {
        $plans = InvestmentPlan::withCount('transactions')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.investment-plans.index', compact('plans'));
    }

    public function investmentPlanShow(InvestmentPlan $investmentPlan)
    {
        $investmentPlan->load('transactions.user');
        return view('admin.investment-plans.show', compact('investmentPlan'));
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
