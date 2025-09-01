<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // session based cart: array of items
    // item: [
    //   'country' => 'SG'|'MX'|'PH'|'MY',
    //   'external_id' => string (unique per item selection),
    //   'title' => string,
    //   'price' => float,
    //   'meta' => array
    // ]

    protected function getCart()
    {
        return session()->get('cart', []);
    }

    protected function saveCart(array $cart)
    {
        session()->put('cart', $cart);
    }

    public function index(Request $request)
    {
        $cart = $this->getCart();
        $total = collect($cart)->sum('price');

        if ($request->wantsJson()) {
            return response()->json(['items' => $cart, 'total' => (float) $total]);
        }

        return view('cart.index', ['cart' => $cart, 'total' => $total]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'country' => 'required|string',
            'external_id' => 'required|string',
            'title' => 'required|string',
            'price' => 'required|numeric',
            'meta' => 'nullable',
        ]);

        $cart = $this->getCart();

        // Prevent duplicates (optional) - use external_id + country as unique key
        $exists = collect($cart)->first(fn($i) => $i['country'] === strtoupper($data['country']) && $i['external_id'] === $data['external_id']);
        if ($exists) {
            // optionally return error or ignore; we'll return updated cart
            if ($request->wantsJson()) {
                return response()->json(['status' => 'exists', 'message' => 'Item already in cart', 'cart' => $cart]);
            }
            return back()->with('info', 'Item already in cart');
        }

        $item = [
            'country' => strtoupper($data['country']),
            'external_id' => $data['external_id'],
            'title' => $data['title'],
            'price' => (float) $data['price'],
            'meta' => $data['meta'] ?? [],
        ];

        $cart[] = $item;
        $this->saveCart($cart);

        if ($request->wantsJson()) {
            return response()->json(['status' => 'ok', 'cart' => $cart]);
        }

        return back()->with('success', 'Added to cart');
    }

    public function remove(Request $request, $index)
    {
        $cart = $this->getCart();
        if (isset($cart[$index])) {
            array_splice($cart, $index, 1);
            $this->saveCart($cart);
        }

        if ($request->wantsJson()) {
            return response()->json(['status' => 'ok', 'cart' => $cart]);
        }

        return back();
    }
}
