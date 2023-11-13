<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use Yajra\Datatables\Html\Builder;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request, Builder $htmlBuilder)
     {
         if ($request->ajax()) {
             $members = Role::where('name', 'member')->first()->users;
             return Datatables::of($members)
                 ->addColumn('name', function ($member) {
                     return '<a href="' . route('members.show', $member->id) . '">' . $member->name . '</a>';
                 })
                 ->addColumn('action', function ($member) {
                     return view('datatable._action', [
                         'model' => $member,
                         'form_url' => route('members.destroy', $member->id),
                         'edit_url' => route('members.edit', $member->id),
                         'confirm_message' => 'Yakin mau menghapus ' . $member->name . '?',
                     ]);
                 })->make(true);
         }
         $html = $htmlBuilder
             ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
             ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email'])
             ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false]);
         return view('members.index', compact('html'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
