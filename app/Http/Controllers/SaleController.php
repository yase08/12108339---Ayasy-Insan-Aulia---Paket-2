<?php

namespace App\Http\Controllers;

use App\Exports\SaleExport;
use App\Models\Customer;
use App\Models\DetailSale;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    public function invoice(Request $request)
    {
        $data = session(["data" => $request->all()]);

        return redirect()->route('sale.invoiceView');
    }

    public function invoiceView()
    {
        $data = session("data");
        $totalPrice = 0;

        foreach ($data["products"] as $productId) {
            $product = Product::find($productId);
            $index = array_search($productId, $data["products"]);
            $totalPrice += $product->price * $data["quantities"][$index];
        }

        foreach ($data["products"] as $productId) {
            $product = Product::find($productId);
            $index = array_search($productId, $data["products"]);
            $detailSale[] = [
                "name" => $product->name,
                "quantity" => $data["quantities"][$index],
                "price" => $product->price,
                "subtotal" => $product->price * $data["quantities"][$index]
            ];
        }

        return view('pages.sale.invoice', compact('data', 'totalPrice', 'detailSale'));
    }

    public function pdf()
    {
        $data = session("data");
        $totalPrice = 0;

        foreach ($data["products"] as $productId) {
            $product = Product::find($productId);
            $index = array_search($productId, $data["products"]);
            $totalPrice += $product->price * $data["quantities"][$index];
        }

        foreach ($data["products"] as $productId) {
            $product = Product::find($productId);
            $index = array_search($productId, $data["products"]);
            $detailSale[] = [
                "name" => $product->name,
                "quantity" => $data["quantities"][$index],
                "price" => $product->price,
                "subtotal" => $product->price * $data["quantities"][$index]
            ];
        }

        $pdf = Pdf::loadView('pages.sale.pdf', ["data" => $data, "totalPrice" => $totalPrice, "detailSale" => $detailSale]);
        return $pdf->download('invoice.pdf');
    }

    public function download($saleId)
    {
        $sale = Sale::with('detailSale.product')->find($saleId);
        $totalPrice = 0;

        $totalPrice = $sale->detailSale->reduce(function ($carry, $detail) {
            return $carry + ($detail->product->price * $detail->amount);
        });

        $detailSale = $sale->detailSale->map(function ($detail) {
            return [
                'name' => $detail->product ? $detail->product->name : 'N/A',
                'price' => $detail->product->price,
                'quantity' => $detail->amount,
                'subtotal' => $detail->product->price * $detail->amount,
            ];
        })->toArray();

        $pdf = Pdf::loadView('pages.sale.pdfdownload', compact('totalPrice', 'sale', 'detailSale'));

        return $pdf->download("invoice-{$saleId}.pdf");
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == "admin") {
            $sales = Sale::all();
        } else {
            $sales = Sale::where("user_id", Auth::user()->id)->get();
        }
        return view('pages.sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where("stock", ">", 0)->get();
        return view('pages.sale.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $data = session("data");
        $totalPrice = 0;

        foreach ($data["products"] as $productId) {
            $product = Product::find($productId);
            $index = array_search($productId, $data["products"]);
            if ($product->stock < $data["quantities"][$index]) {
                return redirect()->back()->with("error", "Stock not enough");
            }
        }

        foreach ($data["products"] as $productId) {
            $product = Product::find($productId);
            $index = array_search($productId, $data["products"]);
            $totalPrice += $product->price * $data["quantities"][$index];
        }

        $newCustomer = Customer::create([
            "name" => $data["name"],
            "address" => $data["address"],
            "phone" => $data["phone"],
        ]);

        $newSale = Sale::create([
            "customer_id" => $newCustomer->id,
            "user_id" => Auth::user()->id,
            "sale_date" => date("Y-m-d H:i:s"),
            "total_price" => $totalPrice,
        ]);

        foreach ($data["products"] as $productId) {
            $product = Product::find($productId);
            $index = array_search($productId, $data["products"]);
            $product->update([
                "stock"  => $product->stock - $data["quantities"][$index],
            ]);

            DetailSale::create([
                "sale_id" => $newSale->id,
                "product_id" => $product->id,
                "amount" => $data["quantities"][$index],
                "subtotal" => $product->price * $data["quantities"][$index],
            ]);
        }

        return redirect()->route('sale')->with("success", "Data created successfully");
    }

    public function Export()
    {
        return Excel::download(new SaleExport, 'sales.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sale = Sale::find($id);
        return view('pages.sale.edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $sale = Sale::find($id);

        $sale->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        return redirect()->route('sale')->with("success", "Data updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return redirect()->route('sale')->with("success", "Data deleted successfully");
    }

    public function updateStock(Request $request, $id)
    {
        dd($request->all());
        $sale = Sale::find($id);
        $sale->update([
            'stock' => $sale->stock + $request->stock
        ]);
        return redirect()->route('sale')->with("success", "Stock updated successfully");
    }
}
