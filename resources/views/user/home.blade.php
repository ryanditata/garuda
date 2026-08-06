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
                            <div class="bg-gradient-to-r from-emerald-600 via-teal-700 to-emerald-800 p-6 sm:p-8 text-white">
                                <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2.5 bg-white/20 backdrop-blur-sm rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="inline-block bg-emerald-900/80 text-emerald-200 text-xs font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider mb-1">
                                                Official Selection Result
                                            </span>
                                            <h2 class="text-2xl sm:text-3xl font-black tracking-tight">Congratulations 🎉</h2>
                                        </div>
                                    </div>
                                    <span class="bg-white text-emerald-800 font-black px-4 py-1.5 rounded-full text-sm shadow-sm flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        ACCEPTED
                                    </span>
                                </div>

                                <div class="text-emerald-50 text-sm sm:text-base leading-relaxed space-y-3 max-w-4xl">
                                    <p>
                                        We are delighted to inform you that you have been officially selected as a <strong class="text-white font-semibold"><em>Garuda Scholarship 2026</em></strong> awardee at <strong class="text-white font-semibold"><em>Universitas Dian Nuswantoro (UDINUS)</em></strong>.
                                    </p>
                                    <p>
                                        Your outstanding academic performance and dedication have brought you this well-deserved recognition. We warmly welcome you to the UDINUS academic community and look forward to supporting your educational journey in Indonesia.
                                    </p>
                                </div>
                            </div>

                            {{-- Steps Workflow Body --}}
                            <div class="p-6 md:p-8 bg-emerald-50/30">
                                <div class="mb-6">
                                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2 mb-2">
                                        Your Next Steps
                                    </h3>
                                    <p class="text-xs sm:text-sm text-gray-600 mb-3">
                                        To confirm your commitment and proceed with the enrollment process, please complete the following steps:
                                    </p>
                                    <div class="bg-white p-4 sm:p-5 rounded-xl border border-emerald-200 shadow-sm">
                                        <ol class="space-y-2 text-xs sm:text-sm text-gray-700 list-decimal list-inside font-medium">
                                            <li><em>Download the Statement Letter Template</em> in this website</li>
                                            <li><em>Print, fill out, and sign</em> the statement letter.</li>
                                            <li><em>Scan</em> the signed document in PDF format.</li>
                                            <li><em>Upload</em> the PDF file through this website</li>
                                        </ol>
                                    </div>
                                </div>

                                {{-- Interactive Steps (Download & Upload) --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    {{-- STEP 1: DOWNLOAD TEMPLATE --}}
                                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between">
                                        <div>
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-800 font-bold flex items-center justify-center text-sm">
                                                    1
                                                </div>
                                                <h4 class="font-bold text-gray-800 text-base">Download Statement Letter Template</h4>
                                            </div>
                                            <p class="text-xs text-gray-600 leading-relaxed mb-4">
                                                Download the official Statement Letter template. Print the document, fill in all requested personal data, and sign it clearly.
                                            </p>
                                        </div>

                                        <div>
                                            @if ($announcement_setting->acceptance_template_path)
                                                <a href="{{ route('user.downloadAcceptanceTemplate') }}" class="w-full inline-flex justify-center items-center px-4 py-3 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg text-sm transition duration-150 shadow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                    Download Statement Letter Template
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
                                                <h4 class="font-bold text-gray-800 text-base">Upload Statement Letter</h4>
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
                                                        Statement Letter Uploaded
                                                    </div>
                                                    <p class="text-xs text-emerald-700 mb-3">Your signed Statement Letter has been securely submitted to the admissions team.</p>
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
                                                            Select Signed Statement Letter (.pdf only, max 2MB):
                                                        </label>
                                                        <input type="file" name="signed_acceptance_letter" id="signed_acceptance_letter" required accept=".pdf"
                                                            class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-gray-300 rounded-lg p-1.5">
                                                    </div>
                                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg text-sm transition duration-150 shadow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                        </svg>
                                                        Submit Signed Statement Letter
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Deadline, Contact & Footer Notice --}}
                                <div class="border-t border-emerald-200/80 pt-6 space-y-4 text-xs sm:text-sm text-gray-700">
                                    <div class="p-3.5 bg-amber-50 border-l-4 border-amber-500 rounded-r-xl">
                                        <p class="text-amber-900 leading-relaxed">
                                            <strong><em>Deadline:</em></strong> Please submit the signed statement letter no later than <strong>[xxxxx]</strong>.
                                        </p>
                                    </div>
                                    <p class="text-gray-600">
                                        Should you have any questions, please contact the <em>Cooperation and International Affairs Office</em> at <a href="mailto:international@dinus.id" class="text-blue-600 font-semibold hover:underline">international@dinus.id</a>
                                    </p>
                                    <div class="border-t border-gray-200 pt-4 text-gray-800">
                                        <p class="font-bold text-emerald-800 text-sm sm:text-base mb-2">Once again, congratulations and welcome to the Dinusian family!</p>
                                        <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                                            <em>Cooperation and International Affairs Office</em><br>
                                            <em>Universitas Dian Nuswantoro</em>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- 🕊️ APPLICANT NOT ACCEPTED HERO & ANNOUNCEMENT (RED THEME) --}}
                        <div class="bg-white border-2 border-rose-500 rounded-2xl shadow-xl overflow-hidden mb-8">
                            {{-- Top Banner --}}
                            <div class="bg-gradient-to-r from-red-700 via-rose-800 to-red-900 p-6 sm:p-8 text-white">
                                <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2.5 bg-white/20 backdrop-blur-sm rounded-xl flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-rose-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="inline-block bg-red-950/80 text-rose-200 text-xs font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider mb-1">
                                                Official Selection Result
                                            </span>
                                            <h2 class="text-2xl sm:text-3xl font-black tracking-tight">Notification for Applicants</h2>
                                        </div>
                                    </div>
                                    <span class="bg-white text-rose-800 font-black px-4 py-1.5 rounded-full text-sm shadow-sm flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        NOT SELECTED
                                    </span>
                                </div>
                            </div>

                            {{-- Announcement Body --}}
                            <div class="p-6 md:p-8 bg-rose-50/30">
                                <div class="space-y-4 text-xs sm:text-sm text-gray-700 leading-relaxed mb-6">
                                    <p>
                                        Thank you for your interest in the <strong class="font-semibold"><em>Garuda Scholarship 2026</em></strong> at <strong class="font-semibold"><em>Universitas Dian Nuswantoro (UDINUS)</em></strong>.
                                    </p>

                                    <p>
                                        We truly appreciate the effort you put into your application. After a thorough and competitive review process, we regret to inform you that <strong class="text-rose-900 font-bold"><em>you have not been selected</em></strong> as a recipient for this year’s intake. Please understand that this decision does not reflect your potential or capabilities. The selection process was highly competitive, and we received many outstanding applications from across the world.
                                    </p>

                                    <p>
                                        We believe in your potential and would be honored to receive your application in the next intake period. Stay connected with UDINUS through our official website and social media for updates on upcoming programs and application periods.
                                    </p>

                                    <p>
                                        We wish you every success in your academic journey ahead.
                                    </p>
                                </div>

                                {{-- Footer Sign-off --}}
                                <div class="border-t border-rose-200/80 pt-5 text-gray-800">
                                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                                        <em>Cooperation and International Affairs Office</em><br>
                                        <em>Universitas Dian Nuswantoro</em>
                                    </p>
                                </div>
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
