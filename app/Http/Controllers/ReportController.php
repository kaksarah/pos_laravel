<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use PDF;


class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start_date = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $end_date = date('Y-m-d');

        if ($request->has('start_date') && $request->start_date != "" && $request->has('end_date') && $request->end_date != "") {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        }

        activity()->log('Membuka menu laporan pendapatan');
        return view('report.index', compact('start_date', 'end_date'));


    }

    public function getData($start, $end)
    {
        $no = 1;
        $data = array();
        $income = 0;
        $total_income = 0;

        while (strtotime($start) <= strtotime($end))
        {
            
            $date = $start;
            $start = date('Y-m-d', strtotime("+1 day", strtotime($start)));

            $total_sale = Sales::where('created_at', 'LIKE', "%$date%")->sum('pay');

            $income = $total_sale;
            $total_income += $income;

            $row = array();
            $row['DT_RowIndex'] = $no++;
            $row['date'] = tanggal_indonesia($date, false);
            $row['sale'] = format_uang($total_sale);
            $row['income'] = format_uang($income);

            $data[] = $row;
        }

        $data[] = [
            'DT_RowIndex' => '',
            'date' => '',
            'sale' => 'Total Pendapatan',
            'income' => format_uang($total_income),
        ];

        return $data;
    }

    public function data($start, $end)
    {
        $data = $this->getData($start, $end);
        return dataTables()
            ->of($data)
            ->make(true);

    }

    public function exportPDF($start, $end)
    {
        $data = $this->getData($start, $end);

        
        $pdf = pdf::loadView('report.pdf', compact('start', 'end', 'data'));
        $pdf->setPaper('a4', 'potrait');

        activity()->log('Mencetak laporan pendapatan');
        
        return $pdf->stream('Laporan-pendapatan-' . date('Y-m-d-his') .'.pdf' );
    }

}
