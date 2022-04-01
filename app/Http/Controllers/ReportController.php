<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use App\Services\ReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    private ReportService $reportService;

    public function __construct(ReportService $reportService) {
        $this->reportService = $reportService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $response = $this->reportService->calculate($data);
        DB::table('reports')->insert([
            'load' => $data['loadNumber'],
           'broker_rate' => $data['brokerRate'],
            'percent'=> floatval($data['percent']),
            'driven_rate' => $data['drivenRate'],
            'rate_balance' => $response['rateBalance'],
            'user_id' => Auth::user()->id,
            'rate_minus_percent' => $response['rateMinusPercent'],
            'created_at' => Carbon::now()
        ]);
        return redirect('/reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('reports')->where('id', '=', $id)->first();
        return view('report.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $response = $this->reportService->calculate($data);
        DB::table('reports')->where('id', '=', $id)->update([
            'load' => $data['loadNumber'],
            'broker_rate' => $data['brokerRate'],
            'percent'=> floatval($data['percent']),
            'driven_rate' => $data['drivenRate'],
            'rate_balance' => $response['rateBalance'],
            'user_id' => Auth::user()->id,
            'rate_minus_percent' => $response['rateMinusPercent'],
            'updated_at' => Carbon::now()
        ]);
        return redirect('/reports');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('reports')->where('id', '=', $id)->delete();
        return redirect('/reports');

    }

    public function report() {
        if(Auth::user() && (Auth::user()->role_id== 2 || Auth::user()->role_id == 1)) {
            $reports = Report::with('user')->paginate(5);
            $count  = $reports->sum('broker_rate');
        } else {
            $reports = DB::table('reports')->where('user_id', '=', Auth::user()->id)->paginate(5);
            $count = $reports->sum('broker_rate');
        }
        $usersName = User::query()
            ->where('role_id', '=', 1)
            ->orWhere('role_id', '=', 3)
            ->select('name')
            ->paginate(5);
        return view('report.index', ['reports'=> $reports, 'count_rent'=> $count, 'usersName' => $usersName]);
    }
    public function searchUser(Request $request) {
        $data = $request->all();
        $usersName = User::query()
            ->where('role_id', '=', 1)
            ->orWhere('role_id', '=', 3)
            ->select('name')
            ->paginate(5);
        if(Auth::user() && (Auth::user()->role_id== 2 || Auth::user()->role_id == 1)) {
            $reports = Report::with('user')
                ->join('users', 'reports.id', '=', 'users.id')
                ->where('users.name', '=', $data['username'])
                ->paginate(5);
            $count  = $reports->sum('broker_rate');
        }
        return view('report.index', ['reports'=> $reports, 'count_rent'=> $count, 'usersName' => $usersName])->with('key',$data['username']);
    }
}
