@extends('admin::layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="rounded-xl bg-[#e4ccb3] p-6">
        <h1 class="text-2xl font-bold">Selamat Datang, Admin</h1>
        <p class="text-sm">Pantau aktivitas dan kelola mitra bakery di platform ini</p>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-4 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <div class="rounded-lg border border-gray-400 p-4">
                <p class="text-xs font-bold uppercase">{{ $stat['label'] }}</p>
                <p class="text-2xl font-bold">{{ $stat['value'] }}</p>
                <p class="text-xs text-green-600">{{ $stat['note'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-4 lg:grid-cols-3">
        <div class="rounded-lg border border-gray-400 p-4 lg:col-span-2">
            <h2 class="mb-3 font-bold">Ringkasan Aktivitas</h2>
            <div class="h-72"><canvas id="aktivitasChart"></canvas></div>
        </div>

        <div class="rounded-lg border border-gray-400 p-4">
            <h2 class="mb-3 font-bold">Makanan Paling Banyak Terjual</h2>
            @foreach ($topFoods as $food)
                <div class="flex items-center justify-between border-b border-gray-200 py-3 text-sm">
                    <div>
                        <p class="font-medium">{{ $food['name'] }}</p>
                        <p class="text-xs text-gray-500">{{ $food['sold'] }} paket</p>
                    </div>
                    <span class="rounded-full bg-green-200 px-3 py-1 text-xs font-medium">{{ $food['percent'] }}%</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7"></script>
    <script>
        new Chart(document.getElementById('aktivitasChart'), {
            type: 'line',
            data: {
                labels: @json($chart['labels']),
                datasets: [
                    { label: 'Transaksi', data: @json($chart['transaksi']), borderColor: '#22c55e', tension: 0.4 },
                    { label: 'Mitra Baru', data: @json($chart['mitra']), borderColor: '#473522', tension: 0.4 },
                ],
            },
            options: { maintainAspectRatio: false },
        });
    </script>
@endpush