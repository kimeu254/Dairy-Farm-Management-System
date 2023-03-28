<?php

namespace App\Http\Controllers;

use App\Models\Cattle;
use App\Models\Ledger;
use App\Models\Milk;
use App\Models\MilkSale;
use App\Models\Stall;
use App\Models\Tag;
use App\Models\Usage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $income_total = Ledger::where('ledger_type','Income')->sum('amount');
            $income = number_format($income_total,2);
            $expense_total = Ledger::where('ledger_type','Expense')->sum('amount');
            $expense = number_format($expense_total,2);
            $milktag = Tag::where('slug','milksale')->first();
            $daily_milk_sale = Ledger::where('tag_id',$milktag->id)->where('created_at', '>=',Carbon::today())->sum('amount');
            $milksaledaily = number_format($daily_milk_sale,2);
            $date = date("d F Y", strtotime(Carbon::today()));
            $milks = Cattle::select(\DB::raw('cattle.id, cattle.cattle_no, SUM(milks.total) as total'))
            ->leftJoin('milks','milks.cattle_id', '=', 'cattle.id')
            ->groupBy('cattle.id','cattle.cattle_no')
            ->get();
            $stalls = Stall::select(\DB::raw('stalls.id, stalls.stall_no, COUNT(cattle.stall_id) as count'))
            ->leftJoin('cattle', 'cattle.stall_id', '=', 'stalls.id')
            ->groupBy('stalls.id','stalls.stall_no')
            ->get();
            $topIncomes = Ledger::with('tag')->where('ledger_type','Income')->orderBy('amount')->paginate(3);
            $usages = Usage::with('inventory')->paginate(6);
            $leg_count = Ledger::count();
            $trans_tot = $income_total-$expense_total;
            $trans = number_format($trans_tot,2);
            return view('dashboard', compact('income','expense','milksaledaily','date','milks','stalls','topIncomes','usages','leg_count','trans'));
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
