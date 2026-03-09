@extends('layouts.app')

@section('title', 'Home - Flare Spark Global')

@section('content')
<div style="background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%); color: white; padding: 100px 0; position: relative;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 20% 50%, rgba(252, 211, 77, 0.1) 0%, transparent 50%);"></div>
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 style="font-size: 3.5rem; font-weight: 700; margin-bottom: 20px; line-height: 1.2;">
                    Grow Your Wealth with Flare Spark Global
                </h1>
                <p style="font-size: 1.2rem; margin-bottom: 30px; opacity: 0.95; line-height: 1.8;">
                    Experience the power of cryptocurrency investments with our cutting-edge platform. 
                    Secure, transparent, and designed for your financial success.
                </p>
                <div>
                    @auth
                        <a href="/dashboard" class="btn" style="background: #FCD34D; color: #7C3AED; border-radius: 50px; padding: 15px 40px; font-weight: 600; text-decoration: none; display: inline-block; margin-right: 15px;">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="/register" class="btn" style="background: #FCD34D; color: #7C3AED; border-radius: 50px; padding: 15px 40px; font-weight: 600; text-decoration: none; display: inline-block; margin-right: 15px;">
                            Get Started
                        </a>
                        <a href="/login" class="btn" style="background: transparent; color: white; border: 2px solid white; border-radius: 50px; padding: 13px 38px; font-weight: 600; text-decoration: none; display: inline-block;">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-6" style="text-align: center;">
                <i class="fas fa-chart-line" style="font-size: 15rem; opacity: 0.2;"></i>
            </div>
        </div>
    </div>
</div>

<div style="background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%); color: white; padding: 60px 0;">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <h3 style="font-size: 2.5rem; font-weight: 700; color: #FCD34D;">10,000+</h3>
                <p style="font-size: 1.1rem;">Active Investors</p>
            </div>
            <div class="col-md-3">
                <h3 style="font-size: 2.5rem; font-weight: 700; color: #FCD34D;">$500M+</h3>
                <p style="font-size: 1.1rem;">Assets Under Management</p>
            </div>
            <div class="col-md-3">
                <h3 style="font-size: 2.5rem; font-weight: 700; color: #FCD34D;">98.5%</h3>
                <p style="font-size: 1.1rem;">Customer Satisfaction</p>
            </div>
            <div class="col-md-3">
                <h3 style="font-size: 2.5rem; font-weight: 700; color: #FCD34D;">24/7</h3>
                <p style="font-size: 1.1rem;">Support Available</p>
            </div>
        </div>
    </div>
</div>

<div style="padding: 80px 0; background: #F9FAFB;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 700; text-align: center; margin-bottom: 50px; color: #7C3AED;">
            Why Choose Flare Spark Global?
        </h2>
        <div class="row">
            <div class="col-md-4" style="margin-bottom: 30px;">
                <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); height: 100%; transition: all 0.3s ease;">
                    <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem; color: white;">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 15px; color: #7C3AED;">Secure & Safe</h3>
                    <p style="color: #6B7280; line-height: 1.8;">Bank-level security with industry-leading encryption and multi-factor authentication</p>
                </div>
            </div>
            <div class="col-md-4" style="margin-bottom: 30px;">
                <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); height: 100%; transition: all 0.3s ease;">
                    <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem; color: white;">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 15px; color: #7C3AED;">Diversified Portfolios</h3>
                    <p style="color: #6B7280; line-height: 1.8;">Multiple investment plans tailored to your risk profile and financial goals</p>
                </div>
            </div>
            <div class="col-md-4" style="margin-bottom: 30px;">
                <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); height: 100%; transition: all 0.3s ease;">
                    <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem; color: white;">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 15px; color: #7C3AED;">Expert Support</h3>
                    <p style="color: #6B7280; line-height: 1.8;">Our team of professionals available 24/7 to assist with your needs</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
