<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\StockTransaction;
use Yajra\DataTables\Facades\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::with('products')->get();

            return DataTables::of($data)->make(true);
        }

        return view('admin.transaction', [
            'title' => 'Barang Keluar',
            'products' => Product::all(),
        ]);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'created_at' => 'required',
            'products_id' => 'required',
            'qty' => 'required',
            'pic' => 'required',
            'note' => 'required'
        ]);

        $invoice = IdGenerator::generate(['table' => 'transactions', 'field' => 'invoice_number', 'length' => 8, 'prefix' => 'BK-']);

        $input = $request->all();
        $input['invoice_number'] = $invoice;
        Transaction::create($input);
        StockTransaction::create([
            'invoice_number' => $input['invoice_number'],
            'products_id' => $input['products_id'],
            'qty' => $input['qty'],
        ]);

        $stock = StockTransaction::where('invoice_number', $input['invoice_number'])->get()->first();
        Product::where('id', $input['products_id'])->decrement('qty', $stock->qty);

        return redirect()->route('admin.transaction')->with('success', 'Data berhasil ditambah!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'created_at' => 'required',
            'pic' => 'required',
            'note' => 'required'
        ]);

        $input = $request->except(['_token', 'submit']);

        Transaction::whereId($request->id)->update($input);
        return redirect()->route('admin.transaction')->with('success', 'Data berhasil diupdate!');
    }

    public function hapus(Request $request)
    {
        $id = $request->input('id');
        $product_id = $request->input('products_id');
        $invoice_number = $request->input('invoice_number');

        $data = Transaction::findOrFail($id);

        $stock = StockTransaction::where('invoice_number', $invoice_number)->get()->first();
        Product::where('id', $product_id)->increment('qty', $stock->qty);

        StockTransaction::where('invoice_number', $invoice_number)->delete();

        $data->delete();

        return redirect()->route('admin.transaction')->with('success', 'Data berhasil dihapus!');
    }
}
