<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->role === 'pharmacy') {
                return redirect()->route('admin.prescriptions');
            }
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    }

    public function dashboard()
    {
        if (auth()->user()->role === 'pharmacy') {
            return redirect()->route('admin.prescriptions');
        }

        $prescriptions = Prescription::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('prescriptions'));
    }
}
