@extends('layouts.app')

@section('title', 'Search Companies')

@section('content')
    <div class="max-w-3xl mx-auto">
        {{-- Search Box --}}
        <form method="GET" action="{{ route('search.index') }}" class="mb-6">
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="🔍 Search companies..."
                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" />
        </form>

        {{-- Results --}}
        <div class="space-y-4">
            @forelse($results as $r)
                <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition flex justify-between items-center">
                    <div>
                        <h2 class="font-bold text-lg text-indigo-700">{{ $r['name'] }}</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            🌍 {{ $r['country'] }} • 🔖 {{ $r['slug'] ?? '' }} • 🏷️ {{ $r['registration_number'] ?? ($r['registration_number'] ?? '') }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('companies.show', ['country' => strtolower($r['country']), 'id' => $r['id']]) }}"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-full shadow hover:bg-indigo-700 transition">
                            View →
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 bg-white p-6 rounded shadow">No results found 🚫</div>
            @endforelse
        </div>
    </div>
@endsection
