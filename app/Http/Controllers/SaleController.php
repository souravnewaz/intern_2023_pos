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

        if($product->stock_in - $product->stock_out == 0) {
            return redirect()->back()->with('error', 'Stock not available!');
        }

        $sale = Sale::whereNull('paid_amount')->first();

        $product->increment('stock_out');
        $product->save();

        if($sale) {

            $productCheck = SaleItem::where('product_id', $product_id)->first();

            if($productCheck) {
                $productCheck->quantity = $productCheck->quantity + 1;
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

        $product->decrement('stock_out');
        $product->save();

        return redirect()->back()->with('success', 'Removed from cart successfully');
    }

    public function updateCart($sale_item_id, Request $request)
    {
        $type = $request->type; //increment or decrement

        $saleItem = SaleItem::with('sale', 'product')->find($sale_item_id);

        $sale = $saleItem->sale;

        if($type == 'increment') {

            if($saleItem->product->stock_in - $saleItem->product->stock_out == 0) {
                return redirect()->back()->with('error', 'Stock not available!');
            }

            $saleItem->quantity = $saleItem->quantity + 1;
            $saleItem->total_price = $saleItem->total_price + $saleItem->price;
            $saleItem->save();

            $sale->subtotal -= $saleItem->price;
            $sale->save();

            $saleItem->product->increment('stock_out');
            $saleItem->product->save();

            return redirect()->back()->with('success', 'Increment successful');
        }

        if($type == 'decrement') {
            
            if($saleItem->quantity == 1) {
                $saleItem->delete();
            }
    
            if($saleItem->quantity > 1) {
                $saleItem->quantity = $saleItem->quantity - 1;
                $saleItem->total_price = $saleItem->total_price - $saleItem->price;
                $saleItem->save();
            }
    
            $sale->subtotal -= $saleItem->price;

            if($sale->subtotal == 0) {
                $sale->delete();
            }
            else {
                $sale->save();
            }

            $saleItem->product->decrement('stock_out');
            $saleItem->product->save();
        }

        return redirect()->back()->with('success', 'Removed from cart successfully');
    }

    public function checkout($sale_id, Request $request)
    {
        $sale = Sale::find($sale_id);

        $paid = $request->paid_amount;
        $due = $sale->subtotal - $paid;

        $sale->paid_amount = $paid;
        $sale->due_amount = $due;
        $sale->customer_id = $request->customer_id;
        $sale->save();

        return redirect()->back()->with('success', 'Sale Complete.');
    }
}
