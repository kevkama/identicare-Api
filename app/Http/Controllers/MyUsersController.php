<?php

namespace App\Http\Controllers;

use App\Models\MyUsers;
use App\Http\Requests\StoreMyUsersRequest;
use App\Http\Requests\UpdateMyUsersRequest;

class MyUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myusers = MyUsers::all();
        return $myusers;
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
    public function store(StoreMyUsersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MyUsers $myUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyUsers $myUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMyUsersRequest $request, MyUsers $myUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyUsers $myUsers)
    {
        //
    }
}
