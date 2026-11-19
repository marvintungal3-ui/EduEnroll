@extends('layouts.app')

@section('title', 'Student Portal')

@section('content')
@php
    $activeCourseRequestCount = $student->courseEnrollmentRequests
        ->whereIn('status', [
            \App\Models\CourseEnrollmentRequest::STATUS_PENDING,
            \App\Models\CourseEnrollmentRequest::STATUS_CANCELLATION_PENDING,
        ])
        ->count();
@endphp

<div class="space-y-8">
    @if (session('status'))
        <div class="flex flex-col gap-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-900 shadow-sm sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm font-semibold">{{ session('status') }}</span>
            </div>
            <a href="{{ route('courses.index') }}" class="rounded-xl bg-emerald-700 px-4 py-2.5 text-center text-xs font-bold text-white transition hover:bg-emerald-800">
                Enroll Now &rarr;
            </a>
        </div>
    @endif

    <section data-scroll-exit class="relative overflow-hidden rounded-[2rem] bg-navy p-6 text-white shadow-xl shadow-navy/10 sm:p-9 lg:p-10">
        <div aria-hidden="true" class="absolute -right-24 -top-32 h-96 w-96 rounded-full border-[48px] border-white/5"></div>
        <div class="relative z-10 grid gap-8 lg:grid-cols-[1fr_auto] lg:items-end">
            <div class="max-w-2xl">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-ncc-gold">Student Portal <span class="mx-2 text-white/35">/</span> Your overview</p>
                <h1 class="mt-3 text-3xl font-extrabold leading-tight sm:text-4xl">Welcome, {{ $student->name }}</h1>
                <p class="mt-3 flex flex-wrap items-center gap-2 text-sm text-white/70">
                    <span>{{ $student->email }}</span>
                    <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-300/20 bg-emerald-300/10 px-2.5 py-1 text-xs font-semibold text-emerald-100">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                        Email verified
                    </span>
                </p>
            </div>
            <a href="{{ route('courses.index') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-ncc-gold px-5 py-3 text-sm font-extrabold text-navy shadow-lg shadow-black/10 transition hover:-translate-y-0.5 hover:bg-amber-300">
                Explore programs <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
    </section>

    <div class="grid gap-4 sm:grid-cols-2">
        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Confirmed courses</p>
            <p class="mt-2 text-3xl font-extrabold text-navy">{{ $student->courses->count() }}</p>
            <p class="mt-1 text-sm text-slate-500">Courses linked to your student record</p>
        </article>
        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Requests in review</p>
            <p class="mt-2 text-3xl font-extrabold text-ncc-maroon">{{ $activeCourseRequestCount }}</p>
            <p class="mt-1 text-sm text-slate-500">Enrollment or cancellation requests awaiting review</p>
        </article>
    </div>

    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.16em] text-ncc-maroon">Academic record</p>
                <h2 class="mt-1 text-xl font-extrabold text-navy">My Courses</h2>
                <p class="mt-1 text-sm text-slate-500">Courses confirmed by NCC administration.</p>
            </div>
            <a href="{{ route('courses.index') }}" class="rounded-xl bg-ncc-maroon px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-ncc-maroonHover">
                Browse Course Catalog
            </a>
        </div>

        @if ($student->courses->isEmpty())
            <div class="mt-6 rounded-2xl border border-dashed border-slate-300 bg-[#f8f8f6] p-8 text-center">
                <p class="font-semibold text-navy">No courses are linked to your account yet.</p>
                <p class="mt-1 text-sm text-slate-500">Your course information will appear here when it is added to your student record.</p>
            </div>
        @else
            <div class="mt-6 overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs uppercase tracking-wide text-slate-500">
                            <th class="pb-3 pr-4">Course</th>
                            <th class="pb-3 pr-4">Department</th>
                            <th class="pb-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student->courses as $course)
                            <tr class="border-b border-slate-100 last:border-0">
                                <td class="py-4 pr-4">
                                    <span class="font-bold text-ncc-maroon">{{ $course->code }}</span>
                                    <span class="ml-2 text-slate-700">{{ $course->title }}</span>
                                </td>
                                <td class="py-4 pr-4 text-slate-600">{{ $course->department->name }}</td>
                                <td class="py-4">
                                    <span class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-800">
                                        Accepted — Awaiting Exam &amp; Interview
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    @php
        $unapprovedCourseRequests = $student->courseEnrollmentRequests
            ->whereIn('status', [
                \App\Models\CourseEnrollmentRequest::STATUS_PENDING,
                \App\Models\CourseEnrollmentRequest::STATUS_CANCELLATION_PENDING,
                \App\Models\CourseEnrollmentRequest::STATUS_REJECTED,
            ]);
    @endphp

    @if ($unapprovedCourseRequests->isNotEmpty())
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8" aria-labelledby="course-requests-heading">
            <div class="mb-5">
                <p class="text-xs font-bold uppercase tracking-[0.16em] text-ncc-maroon">Request tracker</p>
                <h2 id="course-requests-heading" class="mt-1 text-xl font-extrabold text-navy">Course Requests</h2>
                <p class="mt-1 text-sm text-slate-500">Track your course requests and cancellation reviews.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs uppercase tracking-wide text-slate-500">
                            <th class="pb-3 pr-4">Course</th>
                            <th class="pb-3 pr-4">Department</th>
                            <th class="pb-3 pr-4">Requested</th>
                            <th class="pb-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unapprovedCourseRequests as $courseRequest)
                            <tr class="border-b border-slate-100 last:border-0">
                                <td class="py-4 pr-4">
                                    <a href="{{ route('courses.show', $courseRequest->course) }}" class="font-bold text-ncc-maroon hover:underline">
                                        {{ $courseRequest->course->code }}
                                    </a>
                                    <span class="ml-2 text-slate-700">{{ $courseRequest->course->title }}</span>
                                </td>
                                <td class="py-4 pr-4 text-slate-600">{{ $courseRequest->course->department->name }}</td>
                                <td class="whitespace-nowrap py-4 pr-4 text-slate-600">{{ $courseRequest->created_at->format('M j, Y') }}</td>
                                <td class="py-4">
                                    @if ($courseRequest->status === \App\Models\CourseEnrollmentRequest::STATUS_PENDING)
                                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-800">Pending</span>
                                    @elseif ($courseRequest->status === \App\Models\CourseEnrollmentRequest::STATUS_CANCELLATION_PENDING)
                                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-800">Cancellation Pending</span>
                                    @elseif ($courseRequest->status === \App\Models\CourseEnrollmentRequest::STATUS_REJECTED)
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-800">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif
</div>
@endsection
