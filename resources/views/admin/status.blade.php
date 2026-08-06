@extends('admin.layout')
@section('title', 'Data Peserta')
@section('content')
    <div class="container self-center">
        <nav class="text-black font-bold my-6 mx-3" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    <a href="{{ route('admin.index') }}">Home</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('admin.status') }}" class="text-gray-500">Update Status</a>
                </li>
            </ol>
        </nav>
        {{-- Table --}}
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white mx-3">
            <div class="flex flex-col mb-5 text-center text-2xl font-bold">Data Peserta & Pengumuman</div>
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-3 rounded" role="alert">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @elseif(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 my-3 rounded" role="alert">
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            @endif

            {{-- Announcement & Template Control Panel --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 border border-gray-200 rounded-xl">
                {{-- Panel 1: Publikasi Pengumuman --}}
                <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                                Status Publikasi Pengumuman
                            </h3>
                            @if ($announcementSetting->is_published)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-1 border border-green-300">
                                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                    Published (Aktif)
                                </span>
                            @else
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-1 rounded-full flex items-center gap-1 border border-yellow-300">
                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                    Draft (Tertutup)
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-500 mb-3">
                            @if ($announcementSetting->is_published)
                                Hasil kelulusan <strong>dapat dilihat</strong> oleh seluruh peserta di dashboard mereka.
                                @if ($announcementSetting->published_at)
                                    <span class="block text-gray-400 mt-1">Dirilis sejak: {{ $announcementSetting->published_at->format('d M Y, H:i') }} WIB</span>
                                @endif
                            @else
                                Hasil seleksi <strong>disembunyikan</strong> dari peserta (peserta hanya melihat status proses evaluasi).
                            @endif
                        </p>
                    </div>

                    <form id="toggleAnnouncementForm" action="{{ route('admin.toggleAnnouncementPublish') }}" method="POST">
                        @csrf
                        @if ($announcementSetting->is_published)
                            <button type="button" onclick="confirmToggleAnnouncement(event, true)"
                                class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white text-xs font-semibold rounded-lg transition duration-150 ease-in-out shadow-sm hover:shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                                Tarik Pengumuman (Jadikan Draft)
                            </button>
                        @else
                            <button type="button" onclick="confirmToggleAnnouncement(event, false)"
                                class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white text-xs font-semibold rounded-lg transition duration-150 ease-in-out shadow-sm hover:shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Publikasikan Pengumuman Sekarang
                            </button>
                        @endif
                    </form>
                </div>

                {{-- Panel 2: Manajemen Template Kelulusan --}}
                <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Statement Letter Template
                            </h3>
                            @if ($announcementSetting->acceptance_template_path)
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded-full border border-blue-300">
                                    Tersedia
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-1 rounded-full border border-gray-300">
                                    Belum Ada
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-600 mb-3 truncate">
                            @if ($announcementSetting->acceptance_template_path)
                                File: <span class="font-medium text-gray-800">{{ $announcementSetting->template_filename ?? 'Template Dokumen' }}</span>
                            @else
                                Unggah template form penerimaan/LoA yang wajib diisi dan di-TTD peserta yang lulus.
                            @endif
                        </p>
                    </div>

                    <div class="flex gap-2">
                        @if ($announcementSetting->acceptance_template_path)
                            <a href="{{ route('admin.downloadAdminAcceptanceTemplate') }}" class="flex-1 inline-flex justify-center items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs font-semibold rounded-md border border-gray-300 transition duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Unduh
                            </a>
                        @endif
                        <button type="button" onclick="document.getElementById('templateModal').classList.remove('hidden')" class="flex-1 inline-flex justify-center items-center px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-md transition duration-150 shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            {{ $announcementSetting->acceptance_template_path ? 'Ganti Template' : 'Upload Template' }}
                        </button>
                    </div>
                </div>
            </div>

            {{-- Modal Upload Template --}}
            <div id="templateModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                <div class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-md mx-4">
                    <div class="flex justify-between items-center mb-4 border-b pb-2">
                        <h3 class="text-lg font-bold text-gray-800">Upload Template Kelulusan</h3>
                        <button type="button" onclick="document.getElementById('templateModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('admin.uploadAcceptanceTemplate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="template_file" class="block text-sm font-semibold text-gray-700 mb-2">Pilih File Template (.pdf, .doc, .docx):</label>
                            <input type="file" name="template_file" id="template_file" required accept=".pdf,.doc,.docx"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-md p-1">
                            <p class="text-xs text-gray-500 mt-1">Maksimal ukuran file: 5 MB</p>
                        </div>
                        <div class="flex justify-end gap-2 mt-6">
                            <button type="button" onclick="document.getElementById('templateModal').classList.add('hidden')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded text-sm transition">
                                Batal
                            </button>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded text-sm transition flex items-center gap-1 shadow">
                                Upload Template
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <form action="{{ route('admin.status') }}" class="flex items-center my-3">
                    <input type="search" name="search" id="search" placeholder="Cari data..."
                        value="{{ request('search') }}"
                        class="border border-gray-300 p-2 px-4 rounded-md focus:outline-[#003d7a]">
                    <button type="submit"
                        class="ml-2 bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search h-5 w-5"
                            viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>
                </form>
                <form id="paginationForm" method="GET" action="{{ url()->current() }}"
                    class="flex items-center space-x-2">
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <label for="perPage" class="text-sm font-medium text-gray-700">Tampilkan:</label>
                    <select name="perPage" id="perPage" class="border rounded-md py-1 px-2 text-sm"
                        onchange="this.form.submit()">
                        <option value="" {{ request('perPage') == 0 ? 'selected' : '' }}>-- Jumlah data --</option>
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
            </div>
            <table id="example" class="stripe" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                <thead class="bg-[#003d7a] text-white">
                    <tr>
                        <th data-priority="1" class="py-3 px-4 rounded-tl-lg">No.</th>
                        <th data-priority="2" class="py-3 px-4">No. Register</th>
                        <th data-priority="3" class="py-3 px-4">Name</th>
                        <th data-priority="5" class="py-3 px-4">Department</th>
                        <th data-priority="6" class="py-3 px-4">Status</th>
                        <th data-priority="7" class="py-3 px-4 rounded-tr-lg">Action Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applicants as $index => $applicant)
                        <tr class="text-center even:bg-slate-200">
                            <td class="text-sm">{{ $applicants->firstItem() + $index }}</td>
                            <td class="text-sm">{{ $applicant->no_register }}</td>
                            <td class="text-sm">
                                {{ $applicant->document->first_name . ' ' . $applicant->document->family_name }}</td>
                            <td class="text-sm">{{ $applicant->document->department }}</td>
                            <td>
                                @if ($applicant->status_id == 6)
                                    <span
                                        class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @elseif ($applicant->status->id == 5)
                                    <span
                                        class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @elseif ($applicant->status->id == 4)
                                    <span
                                        class="bg-cyan-200 text-cyan-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @elseif ($applicant->status->id == 3)
                                    <span
                                        class="bg-orange-200 text-orange-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @elseif ($applicant->status->id == 2)
                                    <span
                                        class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @else
                                    <span
                                        class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">{{ $applicant->status->name }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="justify-center items-center flex gap-2">
                                    <!-- Acc Button -->
                                    {{-- Button Update --}}
                                    <button id="updateStatus"
                                        class="flex items-center justify-center p-2 bg-blue-700 hover:bg-blue-800 rounded-md my-1">
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                        </a>
                                    </button>
                                    <form id="formUpdate" method="POST"
                                        class="hidden inline-flex items-center p-3 text-sm font-medium"
                                        action="{{ route('admin.updateStatus', $applicant->id) }}">
                                        @csrf
                                        <select name="status"
                                            class="px-3 py-2 text-gray-800 bg-white border border-gray-300 rounded-md me-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                            <option disabled {{ is_null($applicant->status_id) ? 'selected' : '' }}>Select
                                                Status</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}"
                                                    {{ $applicant->status_id == $status->id ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="flex gap-2 text-white">
                                            <button type="submit"
                                                class="flex items-center justify-center p-2 bg-green-300 hover:bg-green-500 rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    class="bi bi-check-lg h-5 w-5" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                                </svg>
                                                <svg aria-hidden="true" id="spinner" role="status"
                                                    class="hidden h-5 w-5 text-white animate-spin" viewBox="0 0 100 101"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                        fill="#E5E7EB" />
                                                    <path
                                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </button>
                                            <button type="button" id="cancelUpdate"
                                                class="flex items-center justify-center p-2 bg-red-300 hover:bg-red-500 rounded-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    class="bi bi-x-lg h-5 w-5" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 9.414l4.293 4.293a1 1 0 0 0 1.414-1.414L9.414 8l4.293-4.293a1 1 0 0 0-1.414-1.414L8 6.586 3.707 2.293a1 1 0 0 0-1.414 1.414L6.586 8 2.293 12.293a1 1 0 0 0 1.414 1.414L8 9.414z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $applicants->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmToggleAnnouncement(event, isPublished) {
            if (event) event.preventDefault();
            const form = document.getElementById('toggleAnnouncementForm');

            if (!isPublished) {
                Swal.fire({
                    title: 'Konfirmasi Publikasi',
                    text: 'Apakah Anda yakin ingin mempublikasikan pengumuman kelulusan?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#059669',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Publikasikan!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'px-5 py-2.5 rounded-lg text-sm font-semibold shadow',
                        cancelButton: 'px-5 py-2.5 rounded-lg text-sm font-semibold'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Memproses...',
                            text: 'Mempublikasikan pengumuman...',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            } else {
                Swal.fire({
                    title: 'Tarik Pengumuman?',
                    text: 'Apakah Anda yakin ingin menarik/menonaktifkan pengumuman kelulusan?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Tarik Pengumuman',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'px-5 py-2.5 rounded-lg text-sm font-semibold shadow',
                        cancelButton: 'px-5 py-2.5 rounded-lg text-sm font-semibold'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Memproses...',
                            text: 'Menarik pengumuman...',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            }
        }

        // Show spinner when button clicked
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitButton = this.querySelector('button[type="submit"]');
                    if (submitButton) {
                        const spinner = submitButton.querySelector('#spinner');

                        submitButton.disabled = true; // Disable the button to prevent multiple submissions
                        const svgIcon = submitButton.querySelector('svg:not(#spinner)');
                        if (svgIcon) svgIcon.classList.add('hidden'); // Hide the original icon
                        if (spinner) spinner.classList.remove('hidden'); // Show the spinner
                    }
                });
            });

            const updateStatus = document.querySelectorAll('#updateStatus');
            const formUpdate = document.querySelectorAll('#formUpdate');
            const cancelUpdate = document.querySelectorAll('#cancelUpdate');
            console.log(updateStatus);
            // Show form update status
            updateStatus.forEach((update, index) => {
                update.addEventListener('click', function() {
                    formUpdate[index].classList.remove('hidden');
                    update.classList.add('hidden');
                });
            });
            cancelUpdate.forEach((cancel, index) => {
                cancel.addEventListener('click', function() {
                    formUpdate[index].classList.add('hidden');
                    updateStatus[index].classList.remove('hidden');
                });
            });
        });
    </script>
@endsection
