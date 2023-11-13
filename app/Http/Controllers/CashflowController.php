<?php

namespace App\Http\Controllers;

use App\Models\Cashflow;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class CashflowController extends Controller
{
    public function API_index()
    {
        $cashflow = DB::table('cashflows')->join(
            'categories',
            'cashflows.category_id',
            '=',
            'categories.id'
        )->get([
            'cashflows.id',
            'cashflows.category_id',
            'cashflows.title',
            'cashflows.type',
            'cashflows.amount',
            'cashflows.created_at',
            'cashflows.updated_at',
            'categories.name as category',
        ]);
        return $cashflow;
    }

    public function index()
    {
        return view('cashflow.index');
    }

    public function create() {
        return view('cashflow.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $data = new Cashflow();
        $data['title'] = $request['title'];
        $data['category_id'] = $request['category'];
        $data['amount'] = $request['amount'];
        $data['type'] = $request['type'];
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = null;
        $data->save();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah cashflow"
        ]);

        return redirect()->route('cashflows.index');
    }

    public function show($id) {
        $data = Cashflow::findOrFail($id);
        return view('cashflow.show', ['data' => $data, 'category' => Category::find($data['category_id'])]);
    }

    public function edit($id)
    {
        return view('cashflow.edit', [
            'data' => Cashflow::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Cashflow::findOrFail($id);
        $data['title'] = $request['title'];
        $data['category_id'] = $request['category'];
        $data['amount'] = $request['amount'];
        $data['type'] = $request['type'];
        $data['created_at'] = $request['created_at'];
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengubah cashflow"
        ]);

        return redirect()->route('cashflows.index');
    }

    public function destroy($id)
    {
        Cashflow::findOrFail($id)->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menghapus cashflow"
        ]);
        return redirect()->route('cashflows.index');
    }

    public function bulkDestroy(Request $req) {
        return DB::table('cashflows')->whereIn('id', $req['data'])->delete();
    }

    public function exportPDF()
    {
        $data = $this->API_index();
        $pdf = PDF::loadView('cashflow.pdf', compact('data'));
        return $pdf->download('cashflow.pdf');
    }
}
