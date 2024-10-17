<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VisitorController extends Controller
{
    public function index()
    {
        return view('admin.pages.visitor.index', [
            'title' => 'Data Visitor'
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {
            $data = Visitor::orderBy('id', 'DESC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($model) {
                    return $model->created_at->translatedFormat('d/m/Y H:i:s');
                })
                ->filter(function ($instance) use ($request) {
                    $dari = $request->get('dari');
                    $sampai = $request->get('sampai');
                    if ($dari && $sampai) {
                        $instance->whereBetween('created_at', [$dari, $sampai]);
                    } elseif ($dari && !$sampai) {
                        $instance->whereDate('created_at', $dari);
                    }
                })
                ->make(true);
        }
    }
}
