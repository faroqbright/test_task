<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>@yield('title', 'Companies')</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
    {{-- Navbar --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('search.index') }}" class="font-bold text-xl text-indigo-600 hover:text-indigo-700">
                Company<span class="text-gray-900">Hub</span>
            </a>

            @php
                $cart = session('cart', []);
                $cartCount = count($cart);
            @endphp

            <div class="relative">
                <a href="{{ route('cart.index') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-full shadow hover:bg-indigo-700 transition flex items-center">
                    <span class="mr-1">🛒</span> Cart
                    @if ($cartCount > 0)
                        <span
                            class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full shadow">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container mx-auto flex-1 p-6">
        {{-- Alerts --}}
        @if (session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-200 text-green-800 shadow">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if (session('info'))
            <div class="mb-4 p-4 rounded-lg bg-yellow-100 border border-yellow-200 text-yellow-800 shadow">
                💡 {{ session('info') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-200 text-red-800 shadow">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white shadow-inner py-4 mt-6 text-center text-sm text-gray-500">
        © {{ date('Y') }} CompanyHub. All rights reserved.
    </footer>
</body>

</html>
