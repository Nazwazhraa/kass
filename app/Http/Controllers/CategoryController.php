<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function API_index()
    {
        $category = DB::table('categories')->get();
        return $category;
    }

    public function index()
    {
        Session::flash("cashflow_tab", [
            "tab" => "category"
        ]);
        return redirect('/cashflows');
    }


    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:categories,name'
            ],
            [
                'name.unique' => 'Nama kategori sudah ada.'
            ]
        );

        $category = new Category();
        $category['name'] = $request['name'];
        $category['created_at'] = date('Y-m-d H:i:s');
        $category['updated_at'] = null;
        $category->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menambah kategori"
        ]);

        Session::flash("cashflow_tab", [
            "tab" => "category"
        ]);
        return redirect('/cashflows');
    }

    public function show($id)
    {
        return view('category.show', ['category' => Category::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('category.edit', ['category' => Category::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:categories,name'
            ],
            [
                'name.unique' => 'Nama kategori sudah ada.'
            ]
        );
        $category = Category::findOrFail($id);
        $category['name'] = $request['name'];
        $category['updated_at'] = date('Y-m-d H:i:s');
        $category->save();

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil mengubah kategori."
        ]);
        Session::flash("cashflow_tab", [
            "tab" => "category"
        ]);

        return redirect('/cashflows');
    }

    public function destroy($id)
    {
        if (Category::findOrFail($id)->cashflows->count() > 0) {
            Session::flash("flash_notification", [
                "level" => "danger",
                "message" => "Kategori tidak dapat dihapus karena masih terhubung dengan beberapa cashflow."
            ]);
            Session::flash("cashflow_tab", [
                "tab" => "category"
            ]);
            return redirect()->route('cashflows.index');
        } else {
            Category::findOrFail($id)->delete();
            Session::flash("flash_notification", [
                "level" => "success",
                "message" => "Berhasil menghapus kategori."
            ]);
            Session::flash("cashflow_tab", [
                "tab" => "category"
            ]);
            return redirect()->route('cashflows.index');
        }
    }

    public function bulkDestroy(Request $req)
    {
        $_canBeDeleted = [];
        foreach ($req['data'] as $e) {
            if (!(DB::table('cashflows')->where('category_id', '=', $e)->count() > 0)) {
                $_canBeDeleted[] = Category::findOrFail($e)['id'];
                Category::find($e)->delete();
            }
        }

        return count($_canBeDeleted);
    }

    public function forceDestroy($id)
    {
        $category = Category::findOrFail($id);
        $name = $category['name'];

        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "Berhasil menghapus kategori " . $name . " ."
        ]);
        Session::flash("cashflow_tab", [
            "tab" => "category"
        ]);

        $category->delete();

        return redirect('/cashflows');
    }
}
