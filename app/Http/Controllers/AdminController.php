<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function prescriptions()
    {
        $prescriptions = Prescription::with(['user', 'quotations'])->latest()->get();
        return view('admin.prescriptions', compact('prescriptions'));
    }
}
