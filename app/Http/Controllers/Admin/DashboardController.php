<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $count = [
            'users' => User::count(),
            'project' => Project::count(),
            'portfolio' => Project::where('is_portfolio', 1)->count(),
            'invoice' => Invoice::where('status', 1)->count()
        ];
        $invoices = Invoice::latest()->limit(10)->get();
        return view('admin.pages.dashboard', [
            'title' => 'Dashboard',
            'count' => $count,
            'invoices' => $invoices
        ]);
    }

    public function ajaxTransaction()
    {
        if (request()->ajax()) {
            $year = Carbon::now()->format('Y');
            $query = Invoice::select(DB::raw('sum(invoices.total) as `nominal`'), DB::raw("DATE_FORMAT(created_at, '%m') month"),  DB::raw('YEAR(created_at) year'))
                ->groupby('month', 'year')
                ->whereYear('created_at', $year)
                ->orderBy('month', 'ASC')
                ->where('status', 1)
                ->get();

            $month = [];
            $bg = [];
            $bg2 = [];
            $nominal = [];
            $qNominal = $query->pluck('nominal');
            $qMonth = $query->pluck('month');

            for ($i = 0; $i < count($qMonth); $i++) {
                $mn = $this->toMonth($qMonth[$i]);
                $b = 'rgba(' . rand(1, 255) . ', ' . rand(1, 255) . ', ' . rand(1, 255) . ', 0.2)';
                $b2 = 'rgba(' . rand(1, 255) . ', ' . rand(1, 255) . ', ' . rand(1, 255) . ', 0.2)';
                array_push($month, $mn);
                array_push($bg, $b);
                array_push($bg2, $b2);
                array_push($nominal, $qNominal[$i]);
            }
            $data = [
                $month,
                $nominal,
                $bg,
                $bg2
            ];

            return response()->json($data);
        }
    }

    private function toMonth($monthNumber)
    {
        switch ($monthNumber) {
            case '01':
                return 'Jan';
                break;
            case '02':
                return 'Feb';
                break;
            case '03':
                return 'Mar';
                break;
            case '04':
                return 'Apr';
                break;
            case '05':
                return 'Mei';
                break;
            case '06':
                return 'Jun';
                break;
            case '07':
                return 'Jul';
                break;
            case '08':
                return 'Agu';
                break;
            case '09':
                return 'Sep';
                break;
            case '10':
                return 'Okt';
                break;
            case '11':
                return 'Nov';
                break;
            case '12':
                return 'Des';
                break;
            default:
                return 'Salah';
        }
    }
}
