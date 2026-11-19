@extends('layouts.app')

@section('title', 'Create Student Account')

@section('content')
<section class="mx-auto grid w-full max-w-5xl overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-2xl shadow-navy/10 lg:grid-cols-[0.8fr_1.2fr]">
    <div class="relative hidden flex-col justify-between overflow-hidden bg-navy p-10 text-white lg:flex xl:p-12">
        <div aria-hidden="true" class="absolute -right-24 -top-20 h-80 w-80 rounded-full border-[40px] border-white/5"></div>
        <div aria-hidden="true" class="absolute -bottom-28 -left-20 h-80 w-80 rounded-full bg-ncc-gold/10 blur-2xl"></div>
        <a href="{{ route('home') }}" class="relative z-10 inline-flex w-fit items-center gap-3">
            <img src="{{ asset('images/ncc-logo.png') }}" alt="" class="h-12 w-12 rounded-full bg-white object-contain p-1 ring-2 ring-ncc-gold">
            <span class="text-sm font-extrabold uppercase tracking-wide">EduEnroll</span>
        </a>

        <div class="relative z-10 max-w-sm">
            <p class="text-xs font-bold uppercase tracking-[0.22em] text-ncc-gold">Start your journey</p>
            <h1 class="mt-4 text-4xl font-extrabold leading-tight xl:text-5xl">Your future starts here.</h1>
            <p class="mt-5 text-sm leading-7 text-white/70">Create your student account to apply, explore academic programs, and keep track of your enrollment.</p>
            <div class="mt-8 flex gap-3">
                <span class="rounded-xl border border-white/15 bg-white/5 px-3 py-2 text-xs font-semibold text-white/80">9 Programs</span>
                <span class="rounded-xl border border-white/15 bg-white/5 px-3 py-2 text-xs font-semibold text-white/80">5 Organizations</span>
            </div>
        </div>

        <p class="relative z-10 text-xs font-medium text-white/50">Northeastern Cebu Colleges · Danao City</p>
    </div>

    <div class="p-6 sm:p-10 lg:p-12">
        <a href="{{ route('home') }}" class="mb-7 inline-flex items-center gap-2 text-sm font-bold text-ncc-maroon transition hover:text-ncc-maroonHover lg:hidden">
            <img src="{{ asset('images/ncc-logo.png') }}" alt="" class="h-9 w-9 rounded-full object-contain">
            EduEnroll
        </a>

        <div class="mb-7">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-ncc-maroon">Student Portal</p>
            <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-navy">Create your account</h2>
            <p class="mt-2 text-sm text-slate-500">We’ll email you a link to verify your address.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="grid gap-x-4 gap-y-4 sm:grid-cols-2" data-single-submit data-clear-on-load autocomplete="off">
            @csrf
            <div class="sm:col-span-2">
                <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Full name</label>
                <input id="name" name="name" type="text" autocomplete="off" maxlength="255" required autofocus
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-ncc-maroon focus:bg-white focus:ring-4 focus:ring-ncc-maroon/10">
                @error('name') <p role="alert" class="mt-1.5 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email address</label>
                <input id="email" name="email" type="email" autocomplete="off" maxlength="255" required
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-ncc-maroon focus:bg-white focus:ring-4 focus:ring-ncc-maroon/10">
                @error('email') <p role="alert" class="mt-1.5 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="contact_number" class="mb-1.5 block text-sm font-semibold text-slate-700">Contact number</label>
                <input id="contact_number" name="contact_number" type="tel" autocomplete="off" maxlength="30" required
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-ncc-maroon focus:bg-white focus:ring-4 focus:ring-ncc-maroon/10">
                @error('contact_number') <p role="alert" class="mt-1.5 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="student_type" class="mb-1.5 block text-sm font-semibold text-slate-700">Student type</label>
                <select id="student_type" name="student_type" required
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-ncc-maroon focus:bg-white focus:ring-4 focus:ring-ncc-maroon/10">
                    <option value="incoming_first_year">Incoming 1st Year</option>
                    <option value="transferee">Transferee</option>
                </select>
                @error('student_type') <p role="alert" class="mt-1.5 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
                <input id="password" name="password" type="password" autocomplete="off" minlength="8" required
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-ncc-maroon focus:bg-white focus:ring-4 focus:ring-ncc-maroon/10">
                @error('password') <p role="alert" class="mt-1.5 text-sm text-red-700">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-slate-700">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="off" minlength="8" required
                       class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-ncc-maroon focus:bg-white focus:ring-4 focus:ring-ncc-maroon/10">
            </div>

            <button type="submit" class="mt-2 w-full rounded-xl bg-ncc-maroon px-4 py-3.5 font-bold text-white shadow-lg shadow-ncc-maroon/15 transition hover:-translate-y-0.5 hover:bg-ncc-maroonHover focus:outline-none focus:ring-2 focus:ring-ncc-gold focus:ring-offset-2 sm:col-span-2">
                Create Account
            </button>
        </form>

        <p class="mt-7 border-t border-slate-100 pt-5 text-center text-sm text-slate-600">
            Already registered?
            <a href="{{ route('login') }}" class="font-bold text-ncc-maroon hover:underline">Sign in</a>
        </p>
    </div>
</section>
@endsection
