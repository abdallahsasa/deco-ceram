<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteRequestMail;

class QuoteController extends Controller
{
    public function index()
    {
        return view('pages.quote');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'project_type' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|string',
            'items.*.variant_name' => 'nullable|string',
            'items.*.meters' => 'nullable|numeric',
            'items.*.quantity' => 'nullable|numeric|min:1',
            'items.*.boxes' => 'nullable|integer',
            'items.*.pcs' => 'nullable|integer',
            'items.*.pcs_per_box' => 'nullable|integer',
            'items.*.sqm_per_box' => 'nullable|numeric',
        ]);

        try {
            $quote = QuoteRequest::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'company' => $validated['company'] ?? null,
                'project_type' => $validated['project_type'] ?? null,
                'message' => $validated['message'] ?? null,
                'status' => 'new',
            ]);

            foreach ($validated['items'] as $item) {
                // Verify product exists before adding (optional but good practice)
                $product = Product::find($item['product_id']);
                if ($product) {
                    $quote->items()->create([
                        'product_id' => $item['product_id'],
                        'variant_name' => $item['variant_name'] ?? null,
                        'meters' => $item['meters'] ?? null,
                        'quantity' => $item['quantity'] ?? null,
                        'boxes' => $item['boxes'] ?? null,
                        'pcs' => $item['pcs'] ?? null,
                        'pcs_per_box' => $item['pcs_per_box'] ?? null,
                        'sqm_per_box' => $item['sqm_per_box'] ?? null,
                    ]);
                }
            }

            // Send notification email
            $quote->load('items.product.collection.brand');
            Mail::to('inquery@deco-ceram.fr')->send(new QuoteRequestMail($quote));

            return response()->json([
                'success' => true,
                'message' => __('messages.quote.success_message') ?? 'Quote request submitted successfully!',
                'quote_id' => $quote->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Error submitting quote request: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => __('messages.quote.error_message') ?? 'An error occurred while submitting your request.',
            ], 500);
        }
    }

    public function thankYou($locale, QuoteRequest $quote)
    {
        $quote->load('items.product.collection.brand');
        return view('pages.quote-thank-you', compact('quote'));
    }
}
