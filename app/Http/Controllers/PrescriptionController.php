<?php
namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrescriptionController extends Controller
{
    public function create()
    {
        return view('prescriptions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'note' => 'nullable|string',
            'delivery_address' => 'required|string',
            'delivery_time' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $prescription = Prescription::create([
            'user_id' => auth()->id(),
            'note' => $request->note,
            'delivery_address' => $request->delivery_address,
            'delivery_time' => $request->delivery_time
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('prescriptions', 'public');
                $prescription->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Prescription uploaded successfully');
    }

    public function show(Prescription $prescription)
    {
        $prescription->load(['images', 'quotations.items']);
        return view('prescriptions.show', compact('prescription'));
    }
}
