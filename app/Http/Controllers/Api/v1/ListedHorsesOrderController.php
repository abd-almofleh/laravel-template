<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\ListedHorsesOrder;
use App\Http\Requests\StoreListedHorsesOrderRequest;
use App\Http\Requests\UpdateListedHorsesOrderRequest;

class ListedHorsesOrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreListedHorsesOrderRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreListedHorsesOrderRequest $request)
  {
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\ListedHorsesOrder $listedHorsesOrder
   * @return \Illuminate\Http\Response
   */
  public function show(ListedHorsesOrder $listedHorsesOrder)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\ListedHorsesOrder $listedHorsesOrder
   * @return \Illuminate\Http\Response
   */
  public function edit(ListedHorsesOrder $listedHorsesOrder)
  {
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateListedHorsesOrderRequest $request
   * @param  \App\Models\ListedHorsesOrder                     $listedHorsesOrder
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateListedHorsesOrderRequest $request, ListedHorsesOrder $listedHorsesOrder)
  {
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\ListedHorsesOrder $listedHorsesOrder
   * @return \Illuminate\Http\Response
   */
  public function destroy(ListedHorsesOrder $listedHorsesOrder)
  {
  }
}
