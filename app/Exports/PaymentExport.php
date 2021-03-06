<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class PaymentExport implements FromView
{
    protected $start;
    protected $end;

    function __construct($start = null, $end = null) {
            // if ($start == '') {
            //     $start = date('Y-m-d');
            // }

            // if ($end == '') {
            //     $end = date('Y-m-d');
            // }
            $this->start = $start;
            $this->end = $end;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;


    // public function collection()
    // {
    //     return Order::select('created_at','order_number', 'pay_amount')
    //     ->with(['invoice' => function($query){
    //         $query->select('invoice_number');
    //     }])
    //     ->where('payment_status','=','Paid')
    //     ->get();
    //     // return Order::all();
    // }
    //  public function headings(): array
    // {
    //     return [
    //         'Order Date',
    //         'Order Number',
    //         'Total Order'
    //     ];
    // }

    // public function title(): string
    // {
    //     return 'Report Order';
    // }

    public function view(): View
    {
        return view('admin.report-order.payment-excel', [
            'orders' => Order::whereDate('created_at', '>=', $this->start)->whereDate('created_at', '<=', $this->end)
        ]);
    }
}
