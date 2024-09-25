<?php

namespace App\Http\Controllers;

use App\Models\SubType;
use Illuminate\Http\Request;

class SubTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subTypes = SubType::get();

        return view('sub_type.index', compact('subTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sub_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $data = $request->except('_token');

        SubType::create([
            'name' => $data['name']
        ]);

        return response()->redirectToRoute('sub_type_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(SubType $subType, $subTypeId)
    {
        $subType = SubType::where('id', $subTypeId)->first();

        return view('sub_type.create', compact('subType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function delete(SubType $subType, $subTypeId)
    {
        SubType::where('id', $subTypeId)->delete();

        return response()->redirectToRoute('sub_type_list');
    }
}
