@extends('layouts.app')

@section('title', 'Student Sign In')
@section('main-class', 'flex w-full flex-grow items-center justify-center bg-[#f5f4f0] px-4 py-10 sm:px-6 lg:py-16')

@section('content')
<section class="grid w-full max-w-5xl overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-2xl shadow-navy/10 lg:grid-cols-[0.9fr_1.1fr]">
    <div class="relative hidden min-h-[34rem] flex-col justify-between overflow-hidden bg-navy p-10 text-white lg:flex xl:p-12">
        <div aria-hidden="true" class="absolute -right-20 -top-20 h-72 w-72 rounded-full border-[36px] border-white/5"></div>
        <div aria-hidden="true" class="absolute -bottom-28 -left-20 h-80 w-80 rounded-full bg-ncc-gold/10 blur-2xl"></div>
        <a href="{{ route('home') }}" class="relative z-10 inline-flex w-fit items-center gap-3">
            <img src="{{ asset('images/ncc-logo.png') }}" alt="" class="h-12 w-12 rounded-full bg-white object-contain p-1 ring-2 ring-ncc-gold">
            <span class="text-sm font-extrabold uppercase tracking-wide">EduEnroll</span>
        </a>

        <div class="relative z-10 max-w-sm">
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-ncc-gold">Northeastern Cebu Colleges</p>
            <h1 class="mt-4 text-4xl font-extrabold leading-tight xl:text-5xl">Welcome back to your next step.</h1>
            <p class="mt-5 text-sm leading-7 text-white/70">Sign in to continue your enrollment journey and keep your academic plans moving forward.</p>
        </div>

        <p class="relative z-10 text-xs font-medium text-white/50">Danao City, Cebu <span class="mx-2 text-ncc-gold">/</span> Excellence · Service · Character</p>
    </div>

    <div class="p-6 sm:p-10 lg:p-12">
        <a href="{{ route('home') }}" class="mb-8 inline-flex items-center gap-2 text-sm font-bold text-ncc-maroon transition hover:text-ncc-maroonHover lg:hidden">
            <img src="{{ asset('images/ncc-logo.png') }}" alt="" class="h-9 w-9 rounded-full object-contain">
            EduEnroll
        </a>

        <div class="mb-8">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-ncc-maroon">Student Portal</p>
            <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-navy">Sign in to your account</h2>
            <p class="mt-2 text-sm text-slate-500">Enter your details below to access your portal.</p>
        </div>

        @if (session('status'))
            <p role="status" class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-800">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5" data-single-submit data-clear-on-load autocomplete="off">
            @csrf
            <div>
                <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email address</label>
                <input id="email" name="email" type="email" autocomplete="off" required autofocus
                       aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                       placeholder="you@example.com"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-ncc-maroon focus:bg-white focus:ring-4 focus:ring-ncc-maroon/10">
                @error('email') <p role="alert" class="mt-1.5 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
                <input id="password" name="password" type="password" autocomplete="off" required
                       aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                       placeholder="Enter your password"
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-ncc-maroon focus:bg-white focus:ring-4 focus:ring-ncc-maroon/10">
                @error('password') <p role="alert" class="mt-1.5 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>

            <label class="flex w-fit cursor-pointer items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-ncc-maroon focus:ring-ncc-maroon">
                Remember me
            </label>

            <button type="submit" class="w-full rounded-xl bg-ncc-maroon px-4 py-3.5 font-bold text-white shadow-lg shadow-ncc-maroon/15 transition hover:-translate-y-0.5 hover:bg-ncc-maroonHover focus:outline-none focus:ring-2 focus:ring-ncc-gold focus:ring-offset-2">
                Sign In
            </button>
        </form>

        <p class="mt-8 border-t border-slate-100 pt-6 text-center text-sm text-slate-600">
            New to the portal?
            <a href="{{ route('register') }}" class="font-bold text-ncc-maroon hover:underline">Create an account</a>
        </p>
    </div>
</section>
@endsection
