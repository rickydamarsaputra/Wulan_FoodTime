<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Order;
use App\OrderDetail;
use App\User;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function order(Request $request, $id)
    {
        $user = User::findOrFail(auth()->user()->id);
        $menu = Menu::findOrFail($id);
        $orderCheck = Order::whereUserId($user->id)->first();

        $this->validate($request, [
            'order_amount' => 'required|integer'
        ]);

        if (empty($orderCheck)) {
            Order::create([
                'user_id' => $user->id,
                'is_order' => 0,
                'payment_amount' => 0
            ]);
        }

        $orderNew = Order::whereUserId($user->id)->first();
        $orderDetailCheck = OrderDetail::whereMenuId($menu->id)->whereOrderId($orderNew->id)->first();
        if (empty($orderDetailCheck)) {
            OrderDetail::create([
                'menu_id' => $menu->id,
                'order_id' => $orderNew->id,
                'order_amount' => $request->order_amount,
                'payment_amount_detail' => $menu->menu_price * $request->order_amount
            ]);
        } else {
            OrderDetail::whereOrderId($orderNew->id)->whereMenuId($menu->id)->update([
                'order_amount' => $orderDetailCheck->order_amount + $request->order_amount,
                'payment_amount_detail' => ($menu->menu_price * $request->order_amount) + $orderDetailCheck->payment_amount_detail
            ]);
        }

        $orderDetailNew = OrderDetail::whereMenuId($menu->id)->whereOrderId($orderNew->id)->first();

        $payments = OrderDetail::whereOrderId($orderNew->id)->get();
        $paymentFinal = 0;
        foreach ($payments as $payment) {
            $paymentFinal += $payment->payment_amount_detail;
        }

        $orderUpdatePayment = Order::whereUserId($user->id)->update([
            'payment_amount' => $paymentFinal
        ]);

        Alert::success($menu->menu_name, 'Your Order Has Been Successfully Put Into The Cart!');
        return redirect(route('customers.check_out'));
    }

    public function checkOut()
    {
        $user = auth()->user();
        $order = Order::whereUserId($user->id)->first();
        if (empty($order)) {
            $orderCheckOuts = null;
        } else {
            $orderCheckOuts = OrderDetail::whereOrderId($order->id)->latest()->get();
        }

        return view('customers._check_out', compact('orderCheckOuts', 'order'));
    }

    public function checkOutMenuDelete($id)
    {
        $userInCheckOut = auth()->user();
        $orderPayment = Order::whereUserId($userInCheckOut->id)->first();
        $orderMenuDelete = OrderDetail::findOrFail($id);
        $orderPayment->update([
            'payment_amount' => $orderPayment->payment_amount - $orderMenuDelete->payment_amount_detail
        ]);
        $orderMenuDelete->delete();

        if ($orderPayment->payment_amount == 0) {
            $orderPayment->delete();
        }
        Alert::error($orderMenuDelete->menu->menu_name, 'Deleted Form Cart List!');
        return redirect()->back();
    }

    public function checkOutMenuUpdate(Request $request, $id)
    {
        $user = auth()->user();
        $orderMenuUpdate = OrderDetail::findOrFail($id);
        if ($request->order_amount <= 0) {
            Alert::error($orderMenuUpdate->menu->menu_name, 'You Cant Fill For Order Amount With 0 Or Under 1!');
            return redirect(route('customers.check_out'));
        } else {
            $orderMenuUpdate->update([
                'order_amount' => $request->order_amount,
                'payment_amount_detail' => $request->order_amount * $orderMenuUpdate->menu->menu_price
            ]);

            $orderNew = Order::whereUserId($user->id)->first();
            $payments = OrderDetail::whereOrderId($orderNew->id)->get();
            $paymentFinal = 0;
            foreach ($payments as $payment) {
                $paymentFinal += $payment->payment_amount_detail;
            }

            $orderUpdatePayment = Order::whereUserId($user->id)->update([
                'payment_amount' => $paymentFinal
            ]);
            Alert::success($orderMenuUpdate->menu->menu_name, 'Order Amount Has Been Updated In Cart!');
            return redirect(route('customers.check_out'));
        }
    }

    public function orderConfirm()
    {
        $user = User::findOrFail(auth()->user()->id);
        $orderConfirm = Order::whereUserId($user->id)->first();
        if ($orderConfirm->is_order == 0) {
            $orderConfirm = Order::whereUserId($user->id)->update([
                'is_order' => 1
            ]);
            Alert::success($user->name, 'Thanks For Your Order!');
            return redirect()->back();
        } else {
            Alert::info($user->name, 'Your Order Is Already In Prossess');
            return redirect()->back();
        }
    }

    public function orderCancel()
    {
        $user = User::findOrFail(auth()->user()->id);
        $orderConfirm = Order::whereUserId($user->id)->first();
        if ($orderConfirm->is_order == 1) {
            $orderConfirm = Order::whereUserId($user->id)->update([
                'is_order' => 0
            ]);
            Alert::error($user->name, 'Your Order Has Been Canceled!');
            return redirect()->back();
        } else {
            Alert::info($user->name, 'Your Order Is Already Canceled');
            return redirect()->back();
        }
    }
}
