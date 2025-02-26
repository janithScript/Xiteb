<?php
namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function create(Prescription $prescription)
    {
        // Add any existing quotation check if needed
        return view('quotations.create', compact('prescription'));
    }

    public function store(Request $request, Prescription $prescription)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.drug_name' => 'required|string|max:255',
            'items.*.strength' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0'
        ]);

        $quotation = Quotation::create([
            'prescription_id' => $prescription->id,
            'pharmacy_id' => auth()->id(),
            'total_amount' => 0,
            'status' => 'pending'
        ]);

        $totalAmount = 0;

        foreach ($request->items as $item) {
            $totalPrice = $item['quantity'] * $item['unit_price'];
            $totalAmount += $totalPrice;

            $quotation->items()->create([
                'drug_name' => $item['drug_name'],
                'strength' => $item['strength'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $totalPrice
            ]);
        }

        $quotation->update(['total_amount' => $totalAmount]);

        return redirect()->route('admin.prescriptions')
            ->with('success', 'Quotation created successfully. Total Amount: Rs. ' . number_format($totalAmount, 2));
    }
}
