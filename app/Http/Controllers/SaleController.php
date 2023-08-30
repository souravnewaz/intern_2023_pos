<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function addToCart($product_id)
    {
        $product = Product::find($product_id);

        $sale = Sale::whereNull('paid_amount')->first();

        if($sale) {

            $productCheck = SaleItem::where('product_id', $product_id)->first();

            if($productCheck) {
                $productCheck->quantity += $productCheck->quantity;
                $productCheck->price = $productCheck->price;
                $productCheck->total_price += $productCheck->price;
                $productCheck->save();
            }
            else {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product_id,
                    'price' => $product->price,
                    'quantity' => 1,
                    'total_price' => $product->price,
                ]);
            }

            $sale->subtotal += $product->price;
            $sale->save();

            return redirect()->back()->with('success', 'Added to cart successfully');
        }

        $sale = Sale::create([
            'seller_id' => auth()->id(),
            'subtotal' => $product->price,
        ]);

        SaleItem::create([
            'sale_id' => $sale->id,
            'product_id' => $product_id,
            'price' => $product->price,
            'quantity' => 1,
            'total_price' => $product->price,
        ]);

        $product->increment('stock_out');
        $product->save();

        return redirect()->back()->with('success', 'Added to cart successfully');
    }

    public function deleteFromCart($sale_item_id)
    {
        $saleItem = SaleItem::with('sale', 'product')->find($sale_item_id);

        $product = $saleItem->product;
        $sale = $saleItem->sale;

        $sale->subtotal -= $product->price;
        $sale->save();

        $saleItem->delete();

        return redirect()->back()->with('success', 'Removed from cart successfully');
    }
}
