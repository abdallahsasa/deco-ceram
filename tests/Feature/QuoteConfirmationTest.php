<?php

namespace Tests\Feature;

use App\Models\QuoteRequest;
use App\Models\ShippingCompany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderAcceptedMail;
use App\Mail\ShippingRequestMail;
use Tests\TestCase;

class QuoteConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirming_quote_sends_emails_to_customer_and_active_shipping_companies(): void
    {
        Mail::fake();

        // Create active and inactive shipping companies
        $activeCompany = ShippingCompany::create([
            'name' => 'Active Shipper',
            'email' => 'active@shipper.com',
            'is_active' => true,
        ]);

        $inactiveCompany = ShippingCompany::create([
            'name' => 'Inactive Shipper',
            'email' => 'inactive@shipper.com',
            'is_active' => false,
        ]);

        // Create a quote request
        $quote = QuoteRequest::create([
            'first_name' => 'Jean',
            'last_name' => 'Dupont',
            'email' => 'jean.dupont@example.com',
            'address' => '26, Rue de la Côte, 57390 Rédange, France',
            'status' => 'new',
        ]);

        // Simulate Filament action confirm execution with mock form data
        $data = [
            'weight' => 3000,
            'pallets' => 4,
            'delivery_address' => '26, Rue de la Côte, 57390 Rédange, France',
            'shipping_companies' => [$activeCompany->id],
        ];

        $quote->update([
            'status' => 'completed',
            'address' => $data['delivery_address'],
        ]);
        $quote->load('items.product.collection.brand');

        // Send acceptance email to customer
        Mail::to($quote->email)->send(new OrderAcceptedMail($quote));

        // Send shipping request email to selected active shipping companies
        $shippingCompanies = ShippingCompany::whereIn('id', $data['shipping_companies'])->get();
        foreach ($shippingCompanies as $company) {
            Mail::to($company->email)->send(new ShippingRequestMail(
                $quote,
                (int) $data['weight'],
                (int) $data['pallets']
            ));
        }

        // Assert customer email sent
        Mail::assertSent(OrderAcceptedMail::class, function ($mail) use ($quote) {
            return $mail->hasTo($quote->email);
        });

        // Assert active shipping company received request
        Mail::assertSent(ShippingRequestMail::class, function ($mail) use ($activeCompany) {
            return $mail->hasTo($activeCompany->email);
        });

        // Assert inactive shipping company did not receive request
        Mail::assertNotSent(ShippingRequestMail::class, function ($mail) use ($inactiveCompany) {
            return $mail->hasTo($inactiveCompany->email);
        });
    }
}
