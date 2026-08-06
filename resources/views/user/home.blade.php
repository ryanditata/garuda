@section('title', 'Dashboard - Garuda Scholarship')

@extends('user.layout')

@section('content')
    <section class="bg-gray-50 min-h-screen py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            @if ($apply_data == null)
                <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-200 text-center">
                    <div class="bg-amber-50 border-l-4 border-amber-500 text-amber-800 p-4 mb-6 text-left rounded" role="alert">
                        <p class="font-bold text-base">Application Notice</p>
                        <p class="text-sm">You have not submitted an application for the Garuda Scholarship yet. Please start your application to join Universitas Dian Nuswantoro.</p>
                    </div>
                    <img src="{{ asset('assets/failed.jpg') }}" alt="No application" class="mx-auto w-full max-w-sm rounded-xl mb-6 shadow-sm">
                    <a href="/apply" class="inline-flex items-center justify-center px-6 py-3 bg-blue-800 hover:bg-blue-900 text-white font-semibold rounded-xl shadow transition duration-200">
                        Start Application Now &rarr;
                    </a>
                </div>
            @else
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                        Welcome, <span class="text-blue-800">{{ $apply_data->document->first_name }} {{ $apply_data->document->family_name }}</span> 👋
                    </h1>
                    <p class="text-gray-500 mt-1 text-sm md:text-base">
                        Garuda Scholarship Portal &bull; Universitas Dian Nuswantoro
                    </p>
                </div>

                {{-- ANNOUNCEMENT & SELECTION STATUS SECTION --}}
                @php
                    $isPublished = $announcement_setting->is_published ?? false;
                    $statusId = $apply_data->status_id;
                    $statusName = $apply_data->status->name ?? 'Under Review';
                    $isAccepted = ($statusId == 5 || strcasecmp($statusName, 'Accepted') === 0);
                @endphp

                @if (!$isPublished)
                    {{-- UNPUBLISHED STATE (DRAFT) --}}
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6 mb-8 shadow-sm">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-blue-600 text-white rounded-xl shadow-md flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center justify-between gap-2 mb-1">
                                    <h2 class="text-lg font-bold text-gray-900">Application Under Evaluation</h2>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-300">
                                        <span class="w-2 h-2 rounded-full bg-blue-500 mr-1.5 animate-pulse"></span>
                                        Review in Progress
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Your application has been received and is currently being thoroughly reviewed by the scholarship selection committee. 
                                    Official selection announcements will be published directly on this portal. Please check back periodically.
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- PUBLISHED STATE --}}
                    @if ($isAccepted)
                        {{-- 🎉 ACCEPTED APPLICANT HERO & WORKFLOW --}}
                        <div class="bg-white border-2 border-emerald-500 rounded-2xl shadow-xl overflow-hidden mb-8">
                            {{-- Top Banner --}}
                            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 p-6 text-white">
                                <div class="flex flex-wrap items-center justify-between gap-3">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-white bg-opacity-20 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="inline-block bg-emerald-800 text-emerald-100 text-xs font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider mb-1">
                                                Official Selection Result
                                            </span>
                                            <h2 class="text-2xl font-black tracking-tight">Congratulations! You Are Accepted!</h2>
                                        </div>
                                    </div>
                                    <span class="bg-white text-emerald-800 font-bold px-4 py-1.5 rounded-full text-sm shadow-sm flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        ACCEPTED
                                    </span>
                                </div>
                                <p class="mt-3 text-emerald-50 text-sm leading-relaxed max-w-3xl">
                                    We are pleased to inform you that you have been awarded the Garuda Scholarship for the <strong>{{ $apply_data->document->department }}</strong> program at Universitas Dian Nuswantoro. Please follow the required confirmation procedures below to secure your placement.
                                </p>
                            </div>

                            {{-- Steps Workflow Body --}}
                            <div class="p-6 md:p-8 bg-emerald-50/40">
                                <h3 class="text-base font-bold text-gray-900 mb-6 flex items-center gap-2">
                                    <span class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-600 text-white text-xs font-bold">!</span>
                                    Mandatory Next Steps for Accepted Applicants:
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- STEP 1: DOWNLOAD TEMPLATE --}}
                                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between">
                                        <div>
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-800 font-bold flex items-center justify-center text-sm">
                                                    1
                                                </div>
                                                <h4 class="font-bold text-gray-800 text-base">Download Acceptance Form</h4>
                                            </div>
                                            <p class="text-xs text-gray-600 leading-relaxed mb-4">
                                                Download the official Letter of Acceptance / Confirmation Form template. Print the document, fill in all requested personal data, and sign it clearly.
                                            </p>
                                        </div>

                                        <div>
                                            @if ($announcement_setting->acceptance_template_path)
                                                <a href="{{ route('user.downloadAcceptanceTemplate') }}" class="w-full inline-flex justify-center items-center px-4 py-3 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg text-sm transition duration-150 shadow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                    Download Acceptance Template
                                                </a>
                                                <p class="text-center text-gray-400 text-xs mt-2 truncate">File: {{ $announcement_setting->template_filename ?? 'Template.pdf' }}</p>
                                            @else
                                                <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg text-xs text-yellow-800">
                                                    Template document is currently being prepared by the administrator. Please check back shortly.
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- STEP 2: UPLOAD SIGNED FORM --}}
                                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between" x-data="{ reuploadOpen: false }">
                                        <div>
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center text-sm">
                                                    2
                                                </div>
                                                <h4 class="font-bold text-gray-800 text-base">Upload Signed Acceptance Letter</h4>
                                            </div>
                                            <p class="text-xs text-gray-600 leading-relaxed mb-4">
                                                Scan your fully completed and signed document as a <strong>PDF file (Max 2MB)</strong> and upload it below to finalize your registration.
                                            </p>
                                        </div>

                                        <div>
                                            @if ($apply_data->document->signed_acceptance_letter)
                                                <div class="p-4 bg-emerald-50 border border-emerald-300 rounded-lg mb-3">
                                                    <div class="flex items-center gap-2 text-emerald-800 font-bold text-sm mb-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                        </svg>
                                                        Signed Document Uploaded
                                                    </div>
                                                    <p class="text-xs text-emerald-700 mb-3">Your signed acceptance document has been securely submitted to the admissions team.</p>
                                                    <div class="flex gap-2">
                                                        <a href="{{ asset('storage/' . $apply_data->document->signed_acceptance_letter) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold rounded transition shadow-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                            View Uploaded File
                                                        </a>
                                                        <button type="button" @click="reuploadOpen = !reuploadOpen" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded transition">
                                                            Replace File
                                                        </button>
                                                    </div>
                                                </div>

                                                {{-- Re-upload Drawer --}}
                                                <div x-show="reuploadOpen" x-cloak class="mt-3 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                                    <form action="{{ route('user.uploadSignedAcceptance') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <label class="block text-xs font-semibold text-gray-700 mb-1">Choose replacement PDF (Max 2MB):</label>
                                                        <input type="file" name="signed_acceptance_letter" required accept=".pdf" class="w-full text-xs text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-gray-300 rounded p-1 mb-2">
                                                        <button type="submit" class="w-full py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded transition shadow">
                                                            Upload New File
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <form action="{{ route('user.uploadSignedAcceptance') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="signed_acceptance_letter" class="block text-xs font-semibold text-gray-700 mb-1">
                                                            Select Signed Document (.pdf only, max 2MB):
                                                        </label>
                                                        <input type="file" name="signed_acceptance_letter" id="signed_acceptance_letter" required accept=".pdf"
                                                            class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-gray-300 rounded-lg p-1.5">
                                                    </div>
                                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg text-sm transition duration-150 shadow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                        </svg>
                                                        Submit Signed Acceptance Form
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- 🕊️ ALL OTHER APPLICANTS (NOT ACCEPTED) AUTOMATICALLY GET REJECTED ANNOUNCEMENT --}}
                        <div class="bg-white border border-gray-200 rounded-2xl shadow-md overflow-hidden mb-8">
                            <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-6 text-white">
                                <div class="flex flex-wrap items-center justify-between gap-3">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-white bg-opacity-10 rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="inline-block bg-gray-700 text-gray-200 text-xs font-semibold px-2.5 py-0.5 rounded-full uppercase tracking-wider mb-1">
                                                Official Selection Result
                                            </span>
                                            <h2 class="text-xl font-bold tracking-tight">Garuda Scholarship Application Result</h2>
                                        </div>
                                    </div>
                                    <span class="bg-red-100 text-red-800 font-bold px-3 py-1 rounded-full text-xs border border-red-300">
                                        Not Accepted
                                    </span>
                                </div>
                            </div>
                            <div class="p-6 md:p-8 bg-gray-50">
                                <p class="text-sm text-gray-700 leading-relaxed mb-4">
                                    Dear <strong>{{ $apply_data->document->first_name }} {{ $apply_data->document->family_name }}</strong>,
                                </p>
                                <p class="text-sm text-gray-600 leading-relaxed mb-4">
                                    Thank you for your interest and the time you invested in applying for the Garuda Scholarship Program at Universitas Dian Nuswantoro.
                                </p>
                                <p class="text-sm text-gray-600 leading-relaxed mb-4">
                                    Due to the extraordinarily high volume of exceptional applications and the limited scholarship quotas available for the <strong>{{ $apply_data->document->department }}</strong> program, we regret to inform you that we are unable to offer you a scholarship award for this academic term.
                                </p>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    We sincerely appreciate your application and wish you the absolute best in your academic journey and future endeavors.
                                </p>
                            </div>
                        </div>
                    @endif
                @endif

                <!-- Profile Summary Card -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 md:p-8 mb-8">
                    <div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-6">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Applicant Profile Details
                        </h2>
                        <a href="/profile" class="text-xs font-semibold text-blue-700 hover:text-blue-900 underline">
                            View Full Profile &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-sm">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Full Name</span>
                            <span class="font-bold text-gray-800">{{ $apply_data->document->first_name }} {{ $apply_data->document->family_name }}</span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Email Address</span>
                            <span class="font-medium text-gray-800">{{ $apply_data->document->email ?? $apply_data->user->email }}</span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Phone Number</span>
                            <span class="font-medium text-gray-800">{{ $apply_data->document->phone_number }}</span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Nationality</span>
                            <span class="font-medium text-gray-800">{{ $apply_data->document->nationality }}</span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Applied Department</span>
                            <span class="font-bold text-blue-900">{{ $apply_data->document->department }}</span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Selection Status</span>
                            @if (!$isPublished)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    Under Evaluation
                                </span>
                            @else
                                @if ($isAccepted)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        Accepted
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        Not Accepted
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>

                    @if ($apply_data->comment && $isPublished)
                        <div class="mt-6 p-4 bg-amber-50 border-l-4 border-amber-400 rounded-r-xl">
                            <h4 class="text-xs font-bold text-amber-800 uppercase tracking-wider mb-1">Committee Note:</h4>
                            <p class="text-sm text-amber-900">{{ $apply_data->comment }}</p>
                        </div>
                    @endif
                </div>

                <!-- Info, Updates, & Contact Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-center hover:shadow-md transition">
                        <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 mb-2">Program Information</h3>
                        <p class="text-gray-500 text-xs mb-4">Learn more about curriculum, campus life, and academic guidelines at UDINUS.</p>
                        <a href="https://dinus.ac.id" target="_blank" class="inline-block bg-blue-50 text-blue-700 hover:bg-blue-100 text-xs font-semibold py-2 px-4 rounded-lg transition">
                            Visit Website &rarr;
                        </a>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-center hover:shadow-md transition">
                        <div class="w-12 h-12 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 mb-2">Important Deadlines</h3>
                        <p class="text-gray-500 text-xs mb-4">Keep track of key dates including document submission and semester onboarding.</p>
                        <a href="#" class="inline-block bg-indigo-50 text-indigo-700 hover:bg-indigo-100 text-xs font-semibold py-2 px-4 rounded-lg transition">
                            View Schedule &rarr;
                        </a>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-center hover:shadow-md transition">
                        <div class="w-12 h-12 bg-teal-100 text-teal-700 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800 mb-2">Need Help?</h3>
                        <p class="text-gray-500 text-xs mb-4">Our international student office is ready to assist you with any questions.</p>
                        <a href="mailto:international@dinus.ac.id" class="inline-block bg-teal-50 text-teal-700 hover:bg-teal-100 text-xs font-semibold py-2 px-4 rounded-lg transition">
                            Contact Support &rarr;
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
