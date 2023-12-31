<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function income()
    {
        $months = Setting::getMonth();
        $years = Setting::getYears();
        return view('admin.pages.report.income.index', [
            'title' => 'Laporan Pendapatan',
            'months' => $months,
            'years' => $years
        ]);
    }

    public function income_export()
    {
        $month = request('month');
        $year = request('year');

        $invoice = Invoice::where('status', 1)->latest();
        if ($month)
            $items = $invoice->whereMonth('created_at', $month);
        if ($year)
            $items = $invoice->whereYear('created_at', $year);

        $items = $invoice->get();

        $pdf = Pdf::loadView('admin.pages.report.income.export', [
            'items' => $items,
            'month' => $month,
            'year' => $year
        ]);
        $fileName = "laporan-pendapatan-" . time() . '.pdf';
        return $pdf->download($fileName);
    }
}
