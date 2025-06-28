<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderApproval;

class OrderApprovalController extends Controller
{
    // Show list of orders to approve/reject
    public function index()
    {
        $orders = OrderApproval::paginate(10);
        return view('admin.approval.index', compact('orders'));


    }

    public function approve(OrderApproval $orderApproval)
    {
        if ($orderApproval->status === 'pending') {
            $orderApproval->update(['status' => 'approved']);
            return redirect()->back()->with('success', 'Order approved.');
        }
        return redirect()->back()->with('error', 'Order already processed.');
    }

    public function reject(OrderApproval $orderApproval)
    {
        if ($orderApproval->status === 'pending') {
            $orderApproval->update(['status' => 'rejected']);
            return redirect()->back()->with('success', 'Order rejected.');
        }
        return redirect()->back()->with('error', 'Order already processed.');
    }
}
