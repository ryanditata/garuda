@extends('admin.layout')
@section('title', 'Daftar Peserta Lolos')
@section('content')
    <div class="container self-center px-3 sm:px-4 py-4 sm:py-6">
        {{-- Breadcrumb --}}
        <nav class="text-black font-bold mb-4 sm:mb-6" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex flex-wrap items-center text-xs sm:text-sm">
                <li class="flex items-center">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-1.5 sm:me-2 text-blue-900 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    <a href="{{ route('admin.index') }}" class="hover:text-blue-700">Home</a>
                    <svg class="fill-current w-2.5 h-2.5 sm:w-3 sm:h-3 mx-2 sm:mx-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center text-gray-600">
                    <span>Peserta Lolos Seleksi</span>
                </li>
            </ol>
        </nav>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-3.5 sm:p-4 mb-4 sm:mb-6 rounded-r-xl shadow-sm flex items-center justify-between text-xs sm:text-sm" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @elseif(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-3.5 sm:p-4 mb-4 sm:mb-6 rounded-r-xl shadow-sm flex items-center gap-2 text-xs sm:text-sm" role="alert">
                <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- Page Header --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-5">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start sm:items-center gap-3">
                    <div class="p-2.5 sm:p-3 bg-emerald-100 text-emerald-700 rounded-xl flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-7 sm:w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight leading-snug">Daftar Peserta Lolos (Accepted)</h1>
                        <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Monitoring peserta lolos dan kelengkapan Signed Acceptance Letter</p>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-2.5 sm:gap-3 self-start md:self-auto">
                    @if ($announcementSetting->is_published)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 sm:px-3.5 sm:py-1.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-300">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Pengumuman: Published
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 sm:px-3.5 sm:py-1.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-300">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            Pengumuman: Draft
                        </span>
                    @endif
                    <a href="{{ route('admin.status') }}" class="text-xs font-semibold text-blue-700 hover:text-blue-900 underline">
                        Kelola Status &rarr;
                    </a>
                </div>
            </div>
        </div>

        {{-- KPI Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            {{-- Total Lolos --}}
            <div class="bg-gradient-to-br from-blue-900 to-indigo-900 text-white rounded-2xl p-5 sm:p-6 shadow-md border border-blue-800 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-blue-200 uppercase tracking-wider">Total Peserta Lolos</p>
                    <h3 class="text-2xl sm:text-3xl font-black mt-1">{{ $totalAccepted }}</h3>
                    <p class="text-xs text-blue-200 mt-0.5">Status seleksi Accepted (ID: 5)</p>
                </div>
                <div class="p-3 sm:p-3.5 bg-white bg-opacity-10 rounded-2xl flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 sm:h-8 sm:w-8 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>

            {{-- Sudah Upload --}}
            <div class="bg-gradient-to-br from-emerald-700 to-teal-800 text-white rounded-2xl p-5 sm:p-6 shadow-md border border-emerald-600 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-emerald-200 uppercase tracking-wider">Sudah Upload Surat</p>
                    <h3 class="text-2xl sm:text-3xl font-black mt-1">{{ $totalUploaded }}</h3>
                    <p class="text-xs text-emerald-200 mt-0.5">
                        @if ($totalAccepted > 0)
                            {{ round(($totalUploaded / $totalAccepted) * 100, 1) }}% dari total lolos
                        @else
                            0% selesai
                        @endif
                    </p>
                </div>
                <div class="p-3 sm:p-3.5 bg-white bg-opacity-10 rounded-2xl flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 sm:h-8 sm:w-8 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            {{-- Belum Upload / Pending --}}
            <div class="bg-gradient-to-br from-amber-600 to-orange-700 text-white rounded-2xl p-5 sm:p-6 shadow-md border border-amber-500 flex items-center justify-between sm:col-span-2 lg:col-span-1">
                <div>
                    <p class="text-xs font-semibold text-amber-200 uppercase tracking-wider">Belum Upload (Pending)</p>
                    <h3 class="text-2xl sm:text-3xl font-black mt-1">{{ $totalPending }}</h3>
                    <p class="text-xs text-amber-200 mt-0.5">Menunggu dokumen tanda tangan</p>
                </div>
                <div class="p-3 sm:p-3.5 bg-white bg-opacity-10 rounded-2xl flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 sm:h-8 sm:w-8 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Main Table Container --}}
        <div class="p-4 sm:p-6 lg:p-8 rounded-2xl shadow-sm bg-white border border-gray-200">
            {{-- Toolbar: Filters in Grid + Action Bar --}}
            <div class="mb-6">
                {{-- Form Filter Grid --}}
                <form action="{{ route('admin.acceptedApplicants') }}" method="GET" class="w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 mb-4">
                        {{-- Search Input --}}
                        <div class="relative lg:col-span-4">
                            <input type="search" name="search" id="search" placeholder="Cari nama, email, no register..."
                                value="{{ request('search') }}"
                                class="w-full pl-9 pr-3 py-2 text-xs sm:text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Department Filter --}}
                        <div class="lg:col-span-3">
                            <select name="department" class="w-full text-xs sm:text-sm border border-gray-300 rounded-xl py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
                                <option value="">-- Semua Department --</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                        {{ $dept }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Upload Status Filter --}}
                        <div class="lg:col-span-3">
                            <select name="upload_status" class="w-full text-xs sm:text-sm border border-gray-300 rounded-xl py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none">
                                <option value="">-- Status Upload Signed --</option>
                                <option value="uploaded" {{ request('upload_status') == 'uploaded' ? 'selected' : '' }}>✅ Sudah Upload</option>
                                <option value="pending" {{ request('upload_status') == 'pending' ? 'selected' : '' }}>⏳ Belum Upload</option>
                            </select>
                        </div>

                        {{-- Filter & Reset Buttons --}}
                        <div class="lg:col-span-2 flex items-center gap-2">
                            <button type="submit" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-blue-900 hover:bg-blue-800 text-white text-xs sm:text-sm font-semibold rounded-xl transition shadow-sm flex-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Filter
                            </button>

                            @if(request()->hasAny(['search', 'department', 'upload_status']))
                                <a href="{{ route('admin.acceptedApplicants') }}" class="px-3 py-2 text-xs font-semibold text-gray-600 hover:text-red-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition text-center">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

                {{-- Action Bar: Info, Export & PerPage --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 pt-3 border-t border-gray-100">
                    <div class="text-xs text-gray-500 font-medium">
                        Menampilkan <span class="font-bold text-gray-800">{{ $applicants->firstItem() ?? 0 }}</span> - <span class="font-bold text-gray-800">{{ $applicants->lastItem() ?? 0 }}</span> dari total <span class="font-bold text-blue-900">{{ $applicants->total() }}</span> peserta lolos
                    </div>

                    <div class="flex items-center justify-between sm:justify-end gap-3">
                        {{-- Export Modal Trigger Button --}}
                        <button type="button" id="btn-export-accepted"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-semibold rounded-xl shadow-sm transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z" />
                                <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z" />
                            </svg>
                            <span>Export Excel</span>
                        </button>

                        {{-- Per Page Selector --}}
                        <form id="perPageForm" method="GET" action="{{ url()->current() }}" class="flex items-center gap-1.5">
                            @foreach(request()->except('perPage') as $key => $val)
                                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                            @endforeach
                            <label for="perPage" class="text-xs text-gray-500 font-medium hidden sm:inline">Show:</label>
                            <select name="perPage" id="perPage" onchange="this.form.submit()" class="text-xs sm:text-sm border border-gray-300 rounded-xl py-2 px-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <option value="10" {{ request('perPage', 10) == 10 ? 'selected' : '' }}>10 / hal</option>
                                <option value="25" {{ request('perPage', 25) == 25 ? 'selected' : '' }}>25 / hal</option>
                                <option value="50" {{ request('perPage', 50) == 50 ? 'selected' : '' }}>50 / hal</option>
                                <option value="100" {{ request('perPage', 100) == 100 ? 'selected' : '' }}>100 / hal</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Table with Inner Horizontal Scroll Only --}}
            <div class="overflow-x-auto w-full rounded-xl border border-gray-200 shadow-sm">
                <table class="w-full text-xs sm:text-sm text-left text-gray-700">
                    <thead class="text-xs uppercase bg-[#003d7a] text-white">
                        <tr>
                            <th scope="col" class="py-3 px-3 sm:px-4 text-center font-bold whitespace-nowrap">No.</th>
                            <th scope="col" class="py-3 px-3 sm:px-4 font-bold whitespace-nowrap">No. Register</th>
                            <th scope="col" class="py-3 px-3 sm:px-4 font-bold min-w-[200px]">Peserta</th>
                            <th scope="col" class="py-3 px-3 sm:px-4 font-bold min-w-[180px]">Kontak</th>
                            <th scope="col" class="py-3 px-3 sm:px-4 font-bold min-w-[180px]">Department</th>
                            <th scope="col" class="py-3 px-3 sm:px-4 text-center font-bold whitespace-nowrap min-w-[170px]">Signed Acceptance Letter</th>
                            <th scope="col" class="py-3 px-3 sm:px-4 text-center font-bold whitespace-nowrap min-w-[100px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($applicants as $index => $applicant)
                            @php
                                $hasSigned = !empty($applicant->document->signed_acceptance_letter);
                            @endphp
                            <tr class="hover:bg-blue-50/50 transition duration-150 {{ $loop->even ? 'bg-gray-50/50' : 'bg-white' }}">
                                <td class="py-3 sm:py-4 px-3 sm:px-4 text-center font-medium text-gray-600 whitespace-nowrap">
                                    {{ $applicants->firstItem() + $index }}
                                </td>
                                <td class="py-3 sm:py-4 px-3 sm:px-4 font-mono font-bold text-blue-900 text-xs whitespace-nowrap">
                                    {{ $applicant->no_register ?? '-' }}
                                </td>
                                <td class="py-3 sm:py-4 px-3 sm:px-4">
                                    <div class="flex items-center gap-2.5 sm:gap-3">
                                        @if(!empty($applicant->document->profile_picture))
                                            <img src="{{ asset('storage/' . $applicant->document->profile_picture) }}" alt="Profile" class="w-8 h-8 sm:w-10 sm:h-10 rounded-full object-cover border border-gray-200 shadow-sm flex-shrink-0">
                                        @else
                                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-xs sm:text-sm flex-shrink-0">
                                                {{ strtoupper(substr($applicant->document->first_name ?? 'U', 0, 1)) }}
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <p class="font-bold text-gray-900 leading-tight">
                                                {{ $applicant->document->first_name }} {{ $applicant->document->family_name }}
                                            </p>
                                            <span class="inline-flex items-center text-[11px] sm:text-xs text-gray-500 mt-0.5">
                                                <svg class="w-3 h-3 mr-1 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                                </svg>
                                                {{ $applicant->document->nationality }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 sm:py-4 px-3 sm:px-4">
                                    <p class="text-xs font-medium text-gray-800 break-all">{{ $applicant->document->email }}</p>
                                    <p class="text-[11px] sm:text-xs text-gray-500 mt-0.5">{{ $applicant->document->phone_number ?? '-' }}</p>
                                </td>
                                <td class="py-3 sm:py-4 px-3 sm:px-4">
                                    <span class="inline-block font-semibold text-[11px] sm:text-xs text-blue-900 bg-blue-50 px-2.5 py-1 rounded-lg border border-blue-200">
                                        {{ $applicant->document->department }}
                                    </span>
                                </td>
                                <td class="py-3 sm:py-4 px-3 sm:px-4 text-center whitespace-nowrap">
                                    @if ($hasSigned)
                                        <div class="flex flex-col items-center gap-1.5">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 sm:py-1 rounded-full text-[11px] sm:text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Sudah Upload
                                            </span>
                                            <a href="{{ asset('storage/' . $applicant->document->signed_acceptance_letter) }}" target="_blank"
                                                class="inline-flex items-center gap-1 px-2 py-0.5 sm:px-2.5 sm:py-1 text-[11px] sm:text-xs font-semibold text-blue-700 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-3.5 sm:w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat Dokumen
                                            </a>
                                        </div>
                                    @else
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 sm:py-1 rounded-full text-[11px] sm:text-xs font-bold bg-amber-100 text-amber-800 border border-amber-300">
                                                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-amber-600 animate-spin flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Belum Upload
                                            </span>
                                            <span class="text-[10px] sm:text-[11px] text-gray-400 font-medium">Pending dokumen</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 sm:py-4 px-3 sm:px-4 text-center whitespace-nowrap">
                                    <div class="inline-flex items-center gap-1.5">
                                        {{-- Detail Button --}}
                                        <a href="{{ route('admin.showApplicant', $applicant->id) }}" title="Lihat Detail Berkas"
                                            class="p-1.5 sm:p-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-semibold shadow-sm transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Download All ZIP Button --}}
                                        <a href="{{ route('admin.downloadZip', $applicant->id) }}" title="Download Semua Berkas (ZIP)"
                                            class="p-1.5 sm:p-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-xs font-semibold shadow-sm transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-10 sm:py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="p-3 bg-gray-100 rounded-full text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <p class="text-xs sm:text-sm font-semibold text-gray-600">Tidak ada data peserta lolos yang sesuai filter.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-5 sm:mt-6">
                {{ $applicants->links() }}
            </div>
        </div>
    </div>

    {{-- Export Modal --}}
    <div id="exportAcceptedModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden transition-opacity p-3 sm:p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-5 sm:p-6 relative animate-fade-in-down mx-auto">
            <div class="flex items-center justify-between border-b pb-3.5 mb-4 sm:mb-5">
                <div class="flex items-center gap-2.5">
                    <div class="p-2 bg-emerald-100 text-emerald-700 rounded-xl flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-base sm:text-lg font-bold text-gray-900">Export Data Peserta Lolos</h3>
                </div>
                <button type="button" id="close-export-modal" class="text-gray-400 hover:text-gray-600 rounded-lg p-1.5">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('admin.exportAcceptedApplicants') }}" method="GET">
                <div class="space-y-3.5 sm:space-y-4 mb-5 sm:mb-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Pilih Department</label>
                        <select name="department" class="w-full text-xs sm:text-sm border border-gray-300 rounded-xl py-2 sm:py-2.5 px-3 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            <option value="">Semua Department (All)</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                    {{ $dept }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Status Upload Signed Letter</label>
                        <select name="upload_status" class="w-full text-xs sm:text-sm border border-gray-300 rounded-xl py-2 sm:py-2.5 px-3 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            <option value="">Semua Status</option>
                            <option value="uploaded" {{ request('upload_status') == 'uploaded' ? 'selected' : '' }}>Hanya yang Sudah Upload</option>
                            <option value="pending" {{ request('upload_status') == 'pending' ? 'selected' : '' }}>Hanya yang Belum Upload (Pending)</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 sm:gap-2.5">
                    <button type="button" id="cancel-export-modal" class="px-3.5 sm:px-4 py-2 text-xs sm:text-sm font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" class="inline-flex items-center gap-1.5 px-4 sm:px-5 py-2 text-xs sm:text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-md transition">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Unduh Excel (.xlsx)
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const exportBtn = document.getElementById('btn-export-accepted');
            const exportModal = document.getElementById('exportAcceptedModal');
            const closeBtn = document.getElementById('close-export-modal');
            const cancelBtn = document.getElementById('cancel-export-modal');

            if (exportBtn && exportModal) {
                exportBtn.addEventListener('click', function() {
                    exportModal.classList.remove('hidden');
                });
            }

            function closeModal() {
                if (exportModal) {
                    exportModal.classList.add('hidden');
                }
            }

            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
            if (exportModal) {
                exportModal.addEventListener('click', function(e) {
                    if (e.target === exportModal) {
                        closeModal();
                    }
                });
            }
        });
    </script>
@endsection
