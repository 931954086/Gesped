<?php 

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function showw($id)
    {
        $invoice = Invoice::with('items.product', 'customer')->findOrFail($id);

        return view('invoices.show', compact('invoice'));
    }
    public function show($id)
{
    $invoice = Invoice::with('items')->findOrFail($id);
    return view('invoices.show', compact('invoice'));
}

}
