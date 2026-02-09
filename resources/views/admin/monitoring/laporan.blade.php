<x-admin-layout>
    <x-slot name="header">Laporan & Export</x-slot>

    <div class="bg-white rounded-lg p-6 border border-gray-200">
        <div class="max-w-md mx-auto">
            <h2 class="text-lg font-semibold text-gray-800 mb-2 text-center">Export Laporan</h2>
            <p class="text-sm text-gray-500 mb-6 text-center">Download laporan inventaris aplikasi dalam format PDF atau Excel</p>

            <!-- Filter -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter OPD (Opsional)</label>
                <select id="opdSelect" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Semua OPD</option>
                    @foreach($opds as $opd)
                        <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Export Buttons -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <button type="button" onclick="exportPdf()" class="px-4 py-3 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                    Export PDF
                </button>
                <button type="button" onclick="exportExcel()" class="px-4 py-3 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                    Export Excel
                </button>
            </div>

            <!-- Info -->
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="p-3 bg-gray-50 rounded-lg">
                    <h4 class="font-medium text-gray-700 mb-1">Format PDF</h4>
                    <p class="text-xs text-gray-500">Laporan terformat untuk cetak</p>
                </div>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <h4 class="font-medium text-gray-700 mb-1">Format Excel</h4>
                    <p class="text-xs text-gray-500">Data mentah untuk analisis</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function exportPdf() {
            const opdId = document.getElementById('opdSelect').value;
            let url = '{{ route("admin.monitoring.laporan.export-pdf") }}';
            if (opdId) url += '?opd_id=' + opdId;
            window.location.href = url;
        }
        function exportExcel() {
            const opdId = document.getElementById('opdSelect').value;
            let url = '{{ route("admin.monitoring.laporan.export-excel") }}';
            if (opdId) url += '?opd_id=' + opdId;
            window.location.href = url;
        }
    </script>
</x-admin-layout>
