@extends('layouts.app')

@section('title', 'Contact Us - Flare Spark Global')

@section('content')
<div style="padding: 80px 0; background: #F9FAFB;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 style="font-size: 2.5rem; font-weight: 700; text-align: center; margin-bottom: 50px; color: #7C3AED;">
                    Get in Touch
                </h2>

                <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                    <form method="POST" action="/contact">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="6" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn" style="background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%); color: white; border: none; padding: 12px 40px; border-radius: 50px; width: 100%; font-weight: 600; cursor: pointer;">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
