@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6 space-y-8">

    {{-- Company Info --}}
    <div class="bg-white shadow-lg rounded-xl p-6">
        <h1 class="text-3xl font-bold text-indigo-700 mb-2">{{ $company->name }}</h1>
        <p class="text-gray-600">🌍 Country: <span class="font-semibold">{{ $country }}</span></p>

        @if($country === 'SG' || $country === 'MX' || $country === 'MY')
            <p class="text-gray-600">🏷️ Registration #: {{ $company->registration_number ?? 'N/A' }}</p>
        @endif

        @if($country === 'MX')
            <p class="text-gray-600">📍 State: {{ $company->state->name ?? 'N/A' }}</p>
        @endif

        @if($country === 'PH')
            <p class="text-gray-600">🔑 SEC Code: {{ $company->registration_number ?? 'N/A' }}</p>
        @endif
    </div>

    {{-- Reports --}}
    <div class="bg-white shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">📊 Available Reports</h2>

        {{-- SG, MX, MY --}}
        @if(in_array($country, ['SG','MX','MY']))
            <div class="grid gap-4">
                @forelse($reports as $report)
                    <div class="flex items-center justify-between border-b py-3 hover:bg-gray-50 rounded transition px-2">
                        <div>
                            <p class="font-medium text-gray-800">{{ $report['title'] }}</p>
                            <p class="text-gray-500 text-sm">
                                💵 Price: <span class="font-semibold">${{ number_format($report['price'], 2) }}</span>
                            </p>
                        </div>
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="country" value="{{ $report['country'] }}">
                            <input type="hidden" name="external_id" value="{{ $report['id'] }}">
                            <input type="hidden" name="title" value="{{ $report['title'] }}">
                            <input type="hidden" name="price" value="{{ $report['price'] }}">
                            <input type="hidden" name="meta" value="{{ json_encode($report['meta']) }}">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-full shadow hover:bg-blue-700 transition">
                                ➕ Add to Cart
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500">No reports available.</p>
                @endforelse
            </div>
        @endif

        {{-- PH Reports --}}
        @if($country === 'PH')
            <div class="space-y-6">
                @forelse($reports as $group)
                    <div class="border-b pb-4">
                        <h3 class="font-semibold text-lg text-indigo-700 flex items-center justify-between">
                            {{ $group['report_type_name'] }}
                            <span class="ml-2 text-sm text-gray-500">💵 ${{ number_format($group['price'],2) }}</span>
                        </h3>
                        <ul class="mt-3 space-y-2">
                            @foreach($group['periods'] as $period)
                                <li class="flex items-center justify-between bg-gray-50 p-3 rounded hover:bg-gray-100 transition">
                                    <span class="text-gray-600 text-sm">📅 Period: {{ $period['period_date'] }}</span>
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="country" value="PH">
                                        <input type="hidden" name="external_id" value="{{ $period['report_id'] }}">
                                        <input type="hidden" name="title" value="{{ $group['report_type_name'] }} - {{ $period['period_date'] }}">
                                        <input type="hidden" name="price" value="{{ $group['price'] }}">
                                        <input type="hidden" name="meta" value="{{ json_encode($period) }}">
                                        <button class="px-3 py-1 bg-blue-600 text-white text-sm rounded-full shadow hover:bg-blue-700 transition">
                                            ➕ Add to Cart
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <p class="text-gray-500">No reports available.</p>
                @endforelse
            </div>
        @endif
    </div>

</div>
@endsection
