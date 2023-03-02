<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Order;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invoice_number' => 'required|unique:orders',
            'user_id' => 'required',
            'total' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        foreach($request->product_id as $key => $product_id) {
            $order = new Order();
            $order->invoice_number = $request->invoice_number;
            $order->product_id = $product_id;
            $order->qty = $request->qty[$key];
            $order->subtotal = $request->subtotal[$key];
            $order->user_id = $request->user_id;
            $order->total = $request->total;
            $order->save();
        }
        \LogActivity::addToLog('Create order with invoice number : ' .$request->invoice_number);

        // $order = Order::create([
        //     'invoice_number' => $request->invoice_number,
        //     'product_id' => $request->product_id,
        //     'qty' => $request->qty,
        //     'subtotal' => $request->subtotal,
        //     'user_id' => $request->user_id,
        //     'total' => $request->total
        // ]);

        return response()->json([
            'message' => 'Success',
            'data'=> $order,
        ]);
    }

    public function show($invoice_number) {
        $data = Order::where('invoice_number', $invoice_number)
                        ->with(['product' => function($qry) {
                            return $qry->select('id','name', 'price');
                        }, 'user' => function($query){
                            return $query->select('id', 'name', 'email');
                        }])
                        ->select('id', 'invoice_number', 'product_id', 'qty', 'subtotal', 'user_id', 'total')
                        ->get();

        return response()->json([
            'message' => 'Success',
            'data' => $data,
        ]);
    }

    public function destroy($invoice_number) {
        $data = Order::where('invoice_number', $invoice_number)->delete();

        return response()->json([
            'message' => 'Order ' . $invoice_number . ' has been canceled',
        ]);
    }

    public function export($invoice_number)
    {
        // $data = Excel::download(new OrderExport, 'order.csv');
        // return response()->json([
        //     'message' => 'Success',
        //     'data' => $data
        // ]);

        $store = Excel::store(new OrderExport($invoice_number), 'ORDER_'. $invoice_number .'.xlsx');
        $data = array(
            'message' => 'Data has been Exported',
            'data' => storage_path('ORDER_'. $invoice_number .'.xlsx')
        );
        return response()->json($data);
    }
}
