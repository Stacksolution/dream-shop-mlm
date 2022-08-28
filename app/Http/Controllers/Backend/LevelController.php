<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LevelMatrixCustomer;
use App\Models\User;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $user_id = Auth()->user()->id;
        $levelcostomer = User::user_tree_level($user_id);
        return view('back-end.level.index',compact('levelcostomer'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LevelMatrixCustomer  $level
     * @return \Illuminate\Http\Response
     */
    public function show(LevelMatrixCustomer $level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LevelMatrixCustomer  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(LevelMatrixCustomer $level)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LevelMatrixCustomer  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LevelMatrixCustomer $level)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LevelMatrixCustomer  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(LevelMatrixCustomer $level)
    {
        //
    }


    /**
     * Checkout the specified user level
     *
     * @param  \App\Models\Request  $level
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $level)
    {
        return view('back-end.customer.level.index');
    }
}
