<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="{{ asset('assets/logo-udinus.png') }}" type="image/x-icon">
    <!-- Memanggil CSS dan JS sekaligus melalui Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- component -->
    <section class="flex flex-col md:flex-row h-screen items-center">
        <div class="bg-indigo-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
            <img src="{{ asset('assets/udinus.jpg') }}" alt="" class="w-full h-full object-cover">
        </div>
        <div
            class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
            flex items-center justify-center">
            <div class="w-full h-100">
                <h1 class="text-xl md:text-2xl font-bold leading-tight mt-12">Log in to your account</h1>
                {{-- if session has success --}}
                @if (session('success'))
                    <div class="mt-10 bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- if session has an error --}}
                @if (session('error'))
                    <div class="mt-10 bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('error') }}
                    </div>
                @endif
                <form id="loginForm" class="mt-6" action="{{ route('user.login') }}" method="POST">
                    @csrf
                    <div>
                        <label class="block text-gray-700">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Enter Email Address"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none"
                            value="{{ old('email') }}" autofocus autocomplete required>
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter Password"
                            minlength="8"
                            class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500
                        focus:bg-white focus:outline-none"
                            required>
                        @error('password')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-right mt-2">
                        <a href="#"
                            class="text-sm font-semibold text-gray-700 hover:text-yellow-700 focus:text-yellow-700"
                            id="forgot-password-link">Forgot Password?</a>
                    </div>
                    <button id="buttonSubmit" type="submit"
                        class="w-full flex items-center justify-center bg-yellow-500 hover:bg-yellow-400 focus:bg-yellow-400 text-white font-semibold rounded-lg px-4 py-3 mt-6 gap-2">
                        <svg id="spinner" width="24" height="24" class="text-blue-500 hidden"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <style>
                                .spinner_5nOS {
                                    transform-origin: center;
                                    animation: spinner_sEAn .75s infinite linear
                                }

                                @keyframes spinner_sEAn {
                                    100% {
                                        transform: rotate(360deg)
                                    }
                                }
                            </style>
                            <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"
                                opacity=".25" />
                            <path
                                d="M10.72,19.9a8,8,0,0,1-6.5-9.79A7.77,7.77,0,0,1,10.4,4.16a8,8,0,0,1,9.49,6.52A1.54,1.54,0,0,0,21.38,12h.13a1.37,1.37,0,0,0,1.38-1.54,11,11,0,1,0-12.7,12.39A1.54,1.54,0,0,0,12,21.34h0A1.47,1.47,0,0,0,10.72,19.9Z"
                                class="spinner_5nOS" />
                        </svg>
                        <span id="buttonText">Login</span>
                    </button>
                </form>
                <hr class="my-6 border-gray-300 w-full">
                {{-- <button type="button" class="w-full block bg-white hover:bg-gray-100 focus:bg-gray-100 text-gray-900 font-semibold rounded-lg px-4 py-3 border border-gray-300">
                    <div class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-6 h-6" viewBox="0 0 48 48"><defs><path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/></svg>
                            <span class="ml-4">
                            Log in
                            with
                            Google
                            </span>
                    </div>
                </button> --}}
                <p class="mt-8">Need an account? <a href="/register"
                        class="text-yellow-500 hover:text-yellow-700 font-semibold">Create an
                        account</a></p>
            </div>
        </div>
    </section>

    {{-- Modal --}}
    <div class="fixed z-10 inset-0 overflow-y-auto hidden opacity-0 transition-opacity ease-out duration-300"
        id="forgot-password-modal">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full scale-95 ease-out duration-300"
                id="modal-content">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-key-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Forgot Your
                                Password</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Please contact our admin to reset your password.</p>
                                <a href="https://wa.me/628112345678" target="_blank"
                                    class="text-sm text-blue-500 hover:text-blue-700">Contact Admin Here</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        id="close-modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Announcement Popup Modal (If Published) --}}
    @if (isset($announcementSetting) && $announcementSetting->is_published)
        <div id="announcement-popup-modal"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm hidden opacity-0 transition-all duration-300">
            <div id="announcement-modal-card"
                class="bg-white rounded-3xl max-w-lg w-full shadow-2xl overflow-hidden border border-gray-100 transform scale-95 transition-all duration-300 relative">
                
                {{-- Header with Gradient & Celebration Icon --}}
                <div class="bg-gradient-to-r from-[#003d7a] via-blue-900 to-indigo-900 px-6 py-5 text-white relative">
                    <button type="button" id="close-announcement-x"
                        class="absolute top-4 right-4 text-white/80 hover:text-white bg-white/10 hover:bg-white/20 rounded-full p-1.5 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-yellow-500/20 text-yellow-400 border border-yellow-400/30 rounded-2xl flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </div>
                        <div>
                            <span class="inline-block px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider bg-yellow-400 text-blue-950 rounded-full font-sans mb-1">
                                OFFICIAL ANNOUNCEMENT
                            </span>
                            <h2 class="text-lg sm:text-xl font-black text-white leading-tight">
                                Selection Results Announced!
                            </h2>
                        </div>
                    </div>
                </div>

                {{-- Modal Body --}}
                <div class="p-6 sm:p-7">
                    <p class="text-sm sm:text-base font-bold text-gray-800 mb-2">
                        Dear Garuda Scholarship Applicants,
                    </p>
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-4">
                        The selection results for the Garuda Scholarship at Universitas Dian Nuswantoro have been officially announced. Please log in to your account to check your admission status (<em>Accepted / Rejected</em>) on the dashboard.
                    </p>

                    <div class="bg-blue-50 border-l-4 border-blue-600 p-3.5 rounded-r-xl mb-6">
                        <div class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-blue-700 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs text-blue-900 font-medium leading-normal">
                                For applicants who are <strong>Accepted</strong>, please download the <em>Statement Letter Template</em> and re-upload the signed document through your account dashboard.
                            </p>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row items-center gap-2.5">
                        <button type="button" id="btn-login-cta"
                            class="w-full sm:flex-1 py-3 px-4 bg-yellow-500 hover:bg-yellow-400 text-gray-950 font-bold text-xs sm:text-sm rounded-xl shadow-md transition flex items-center justify-center gap-2">
                            <span>Log In & Check Results</span>
                        </button>
                        <button type="button" id="close-announcement-btn"
                            class="w-full sm:w-auto py-3 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs sm:text-sm rounded-xl transition text-center">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- End modal --}}
    <!-- Scripts -->
    <script>
        const forgotPasswordLink = document.getElementById('forgot-password-link');
        const forgotPasswordModal = document.getElementById('forgot-password-modal');
        const modalContent = document.getElementById('modal-content');
        const closeModal = document.getElementById('close-modal');

        if (forgotPasswordLink && forgotPasswordModal && modalContent && closeModal) {
            forgotPasswordLink.addEventListener('click', function(e) {
                e.preventDefault();
                forgotPasswordModal.classList.remove('hidden');
                setTimeout(() => {
                    forgotPasswordModal.classList.remove('opacity-0');
                    modalContent.classList.remove('scale-95');
                }, 10); // slight delay for smooth transition
            });

            closeModal.addEventListener('click', function() {
                forgotPasswordModal.classList.add('opacity-0');
                modalContent.classList.add('scale-95');
                setTimeout(() => {
                    forgotPasswordModal.classList.add('hidden');
                }, 300); // match the duration of the transition
            });
        }

        // Announcement Popup Modal Logic
        const announcementModal = document.getElementById('announcement-popup-modal');
        const announcementCard = document.getElementById('announcement-modal-card');
        const closeAnnouncementX = document.getElementById('close-announcement-x');
        const closeAnnouncementBtn = document.getElementById('close-announcement-btn');
        const btnLoginCta = document.getElementById('btn-login-cta');

        function openAnnouncementModal() {
            if (!announcementModal || !announcementCard) return;
            announcementModal.classList.remove('hidden');
            setTimeout(() => {
                announcementModal.classList.remove('opacity-0');
                announcementCard.classList.remove('scale-95');
                announcementCard.classList.add('scale-100');
            }, 50);
        }

        function hideAnnouncementModal() {
            if (!announcementModal || !announcementCard) return;
            announcementModal.classList.add('opacity-0');
            announcementCard.classList.remove('scale-100');
            announcementCard.classList.add('scale-95');
            setTimeout(() => {
                announcementModal.classList.add('hidden');
            }, 300);
            sessionStorage.setItem('garuda_announcement_seen', 'true');
        }

        if (announcementModal) {
            // Auto open modal on page load if not closed in this session
            window.addEventListener('DOMContentLoaded', () => {
                if (!sessionStorage.getItem('garuda_announcement_seen')) {
                    setTimeout(openAnnouncementModal, 300);
                }
            });

            if (closeAnnouncementX) closeAnnouncementX.addEventListener('click', hideAnnouncementModal);
            if (closeAnnouncementBtn) closeAnnouncementBtn.addEventListener('click', hideAnnouncementModal);
            if (btnLoginCta) {
                btnLoginCta.addEventListener('click', () => {
                    hideAnnouncementModal();
                    const emailInput = document.getElementById('email');
                    if (emailInput) {
                        emailInput.focus();
                    }
                });
            }

            announcementModal.addEventListener('click', (e) => {
                if (e.target === announcementModal) {
                    hideAnnouncementModal();
                }
            });
        }

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const buttonSubmit = document.getElementById('buttonSubmit');
            const spinner = document.getElementById('spinner');
            const buttonText = document.getElementById('buttonText');

            if (email === '' || password === '') {
                alert('Email dan Password tidak boleh kosong!');
                event.preventDefault();
                return;
            }

            buttonSubmit.disabled = true;
            buttonText.innerText = 'Loading...';
            spinner.classList.remove('hidden');
        });
    </script>
</body>

</html>

