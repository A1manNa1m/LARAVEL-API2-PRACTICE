<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Payment;
use App\Models\Invoice;
use App\Http\Requests\V1\StorePaymentRequest;
use App\Http\Requests\V1\UpdatePaymentRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PaymentCollection;
use App\Http\Resources\V1\PaymentResource;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PaymentCollection(Payment::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $data = $request->validated();
        $invoice = Invoice::findOrFail($data['invoice_id']);
        
        $totalPaid = $invoice->payments()->sum('amount');
        $newTotalPaid = $totalPaid + $data['amount'];

        // Update invoice status based on payment amount
        if ($newTotalPaid == $invoice->amount) {
            $invoice->status = 'FP'; // Full Paid
            $invoice->paid_date = now();
        } elseif ($newTotalPaid > $invoice->amount) {
            $invoice->status = 'OP'; // Over Paid
            $invoice->paid_date = now();
        } elseif ($newTotalPaid > 0) {
            $invoice->status = 'HP'; // Half Paid
            $invoice->paid_date = null;
        } else {
            $invoice->status = 'B'; // Still billed
            $invoice->paid_date = null;
        }

        $invoice->save();

        $payment = Payment::create($data);
        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $validatedData = $request->validated();

        // Use the invoice_id from the request OR fallback to existing payment's invoice_id
        $invoiceId = $validated['invoice_id'] ?? $payment->invoice_id;
        $invoice = Invoice::findOrFail($invoiceId);

        // Use amount from request OR fallback to current amount
        $newAmount = $validated['amount'] ?? $payment->amount;

        // Adjust totals
        $totalPaid = $invoice->payments()->sum('amount') - $payment->amount;
        $newTotal = $totalPaid + $newAmount;

        // Update invoice status
        if ($newTotal == $invoice->amount) {
            $invoice->status = 'FP';
            $invoice->paid_date = now();
        } elseif ($newTotal > $invoice->amount) {
            $invoice->status = 'OP';
            $invoice->paid_date = now();
        } elseif ($newTotal > 0) {
            $invoice->status = 'HP';
            $invoice->paid_date = null;
        } else {
            $invoice->status = 'B';
            $invoice->paid_date = null;
        }

        $invoice->save();
        
        $payment->update($validatedData);
        return response()->json([
                'message' => 'Payment updated successfully', 
                'data' => new PaymentResource($payment)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
