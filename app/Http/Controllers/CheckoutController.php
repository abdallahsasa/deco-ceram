<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('pages.checkout');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'address' => 'required|string|max:1000',
            'items' => 'required|array',
            'items.*.product_id' => 'required|string',
            'items.*.variant_name' => 'nullable|string',
            'items.*.meters' => 'nullable|numeric',
            'items.*.quantity' => 'nullable|numeric|min:1',
            'items.*.boxes' => 'nullable|integer',
            'items.*.pcs' => 'nullable|integer',
            'items.*.pcs_per_box' => 'nullable|integer',
            'items.*.sqm_per_box' => 'nullable|numeric',
            'items.*.price' => 'nullable|numeric',
            'items.*.total' => 'nullable|numeric',
            'subtotal' => 'required|numeric',
            'total_amount' => 'required|numeric',
        ]);

        try {
            $order = Order::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'company' => $validated['company'] ?? null,
                'address' => $validated['address'] ?? null,
                'subtotal' => $validated['subtotal'],
                'total_amount' => $validated['total_amount'],
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            foreach ($validated['items'] as $item) {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $order->items()->create([
                        'product_id' => $item['product_id'],
                        'variant_name' => $item['variant_name'] ?? null,
                        'meters' => $item['meters'] ?? null,
                        'quantity' => $item['quantity'] ?? null,
                        'boxes' => $item['boxes'] ?? null,
                        'pcs' => $item['pcs'] ?? null,
                        'pcs_per_box' => $item['pcs_per_box'] ?? null,
                        'sqm_per_box' => $item['sqm_per_box'] ?? null,
                        'price' => $item['price'] ?? 0,
                        'total' => $item['total'] ?? 0,
                    ]);
                }
            }

            // Send Emails
            try {
                \Illuminate\Support\Facades\Mail::to('abdo.al.sasa@gmail.com')->send(new \App\Mail\OrderCreatedMail($order));
                if ($order->email) {
                    \Illuminate\Support\Facades\Mail::to($order->email)->send(new \App\Mail\UserOrderConfirmationMail($order));
                }
            } catch (\Exception $e) {
                Log::error('Error sending order emails: ' . $e->getMessage());
            }
            return response()->json([
                'success' => true,
                'message' => __('messages.checkout.success_message') ?? 'Order submitted successfully!',
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Error submitting order: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => __('messages.checkout.error_message') ?? 'An error occurred while submitting your order.',
            ], 500);
        }
    }

    public function thankYou($locale, Order $order)
    {
        $order->load('items.product.collection.brand');
        return view('pages.checkout-thank-you', compact('order'));
    }
}
