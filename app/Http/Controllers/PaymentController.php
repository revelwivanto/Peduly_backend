<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function show(Property $property)
    {
        return view('frontend.payment.show', compact('property'));
    }

    public function process(Request $request, Property $property)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'has_tshirt' => 'nullable|boolean',
        ]);

        if (!$request->has_tshirt) {
            // Store the payment data in session
            Session::put('payment_data', [
                'name' => $request->name,
                'phone' => $request->phone,
                'property_id' => $property->id,
                'base_price' => $property->price
            ]);
            
            // Redirect to t-shirt selection
            return redirect()->route('payment.tshirt', $property->slug);
        }

        // If user has t-shirt, proceed with payment
        return $this->processPayment($request->name, $request->phone, $property, null);
    }

    public function tshirtSelection(Property $property)
    {
        // Check if we have payment data in session
        if (!Session::has('payment_data')) {
            return redirect()->route('payment.show', $property->slug);
        }

        return view('frontend.payment.tshirt', compact('property'));
    }

    public function processTshirt(Request $request, Property $property)
    {
        $request->validate([
            'tshirt_size' => 'required|string|in:S,M,L,XL,XXL',
        ]);

        // Get payment data from session
        $paymentData = Session::get('payment_data');
        if (!$paymentData) {
            return redirect()->route('payment.show', $property->slug);
        }

        // Process payment with t-shirt
        return $this->processPayment(
            $paymentData['name'],
            $paymentData['phone'],
            $property,
            $request->tshirt_size
        );
    }

    private function processPayment($name, $phone, $property, $tshirtSize)
    {
        $basePrice = $property->price;
        $finalPrice = $tshirtSize ? $basePrice + 10 : $basePrice;

        // If t-shirt size is provided, we will redirect the user to the WhatsApp group.
        // The previous WhatsApp API integration code is removed as it was too complex.

        // Clear session data
        Session::forget('payment_data');

        // Redirect to the WhatsApp group invite link
        return redirect()->to('https://chat.whatsapp.com/JuhYsG2REWxJQqE4lxpVX2');
    }
} 