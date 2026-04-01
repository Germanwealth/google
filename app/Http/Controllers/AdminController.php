<?php

namespace App\Http\Controllers;

use App\Models\GoogleFormSubmission;
use Illuminate\Http\Request;

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

