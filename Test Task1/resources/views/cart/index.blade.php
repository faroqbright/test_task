@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h1 class="text-3xl font-bold mb-6 text-indigo-700">🛒 Your Cart</h1>

            @if (count($cart))
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="text-left text-gray-600 border-b">
                            <th class="pb-3">📄 Title</th>
                            <th class="pb-3">🌍 Country</th>
                            <th class="pb-3">💵 Price</th>
                            <th class="pb-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $i => $item)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="py-3 font-medium">{{ $item['title'] }}</td>
                                <td class="text-gray-600">{{ $item['country'] }}</td>
                                <td class="font-semibold">${{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.remove', $i) }}">
                                        @csrf
                                        <button class="px-3 py-1 bg-red-500 text-white text-sm rounded-full hover:bg-red-600 shadow transition">
                                            ✖ Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6 text-right text-lg font-bold text-gray-800">
                    Total: 💰 ${{ number_format($total, 2) }}
                </div>
            @else
                <div class="text-center text-gray-600 py-10">
                    🛍️ Your cart is empty.
                </div>
            @endif
        </div>
    </div>
@endsection
