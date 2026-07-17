<div id="exportModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-center">
            <img src="{{ asset('assets/archive.jpg') }}" alt="Archive Image" class="h-40 w-40 mr-4">
        </div>
        <div class="flex justify-center mb-4">
            <h3 class="text-lg font-bold">Export Data</h3>
        </div>
        <p class="text-gray-600 mb-4">Exporting data will create a downloadable Excel file. You can choose a specific department to export or export all.</p>
        <form action="{{ route('admin.exportSpecificAllData') }}" method="GET">
            @csrf
            <label for="export-department" class="block mb-2 font-bold">Select Department:</label>
            <select id="export-department" name="department" class="border border-gray-300 p-2 rounded-md w-full mb-4">
                <option value="">All</option>
                @foreach ($departments as $dept)
                    <option value="{{ $dept }}">{{ $dept }}</option>
                @endforeach
            </select>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeModal('exportModal')" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Export
                </button>
            </div>
        </form>
    </div>
</div>
