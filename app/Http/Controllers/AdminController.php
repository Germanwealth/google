<?php

namespace App\Http\Controllers;

use App\Mail\AdminVerificationMail;
use App\Models\GoogleFormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_submissions' => GoogleFormSubmission::count(),
        ];

        $recent_submissions = GoogleFormSubmission::orderBy('created_at', 'desc')->limit(10)->get();

        return view('admin.dashboard', compact('stats', 'recent_submissions'));
    }

    public function sendVerificationEmail(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        dispatch(function () use ($data): void {
            try {
                Mail::to($data['email'])->send(new AdminVerificationMail('https://fugi.world'));
            } catch (Throwable $exception) {
                Log::error('Admin verification email failed to send.', [
                    'email' => $data['email'],
                    'message' => $exception->getMessage(),
                ]);
            }
        })->afterResponse();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', "Verification email queued for {$data['email']}.");
    }

    public function submissions()
    {
        $submissions = GoogleFormSubmission::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.submissions.index', compact('submissions'));
    }

    public function submissionShow(GoogleFormSubmission $submission)
    {
        return view('admin.submissions.show', compact('submission'));
    }

    public function submissionDelete(GoogleFormSubmission $submission)
    {
        $email = $submission->email;
        $submission->delete();

        return redirect()->route('admin.submissions')
                       ->with('success', "Submission from '{$email}' deleted successfully");
    }
}
