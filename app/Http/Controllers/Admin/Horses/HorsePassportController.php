<?php

namespace App\Http\Controllers\Admin\Horses;

use App\Http\Controllers\Controller;
use App\Models\HorsePassport;
use Illuminate\Http\Request;

class HorsePassportController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->middleware('auth');
    $this->middleware('permission:cmscategory-list', ['only' => ['index', 'store']]);
    $this->middleware('permission:cmscategory-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:cmscategory-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:cmscategory-delete', ['only' => ['destroy']]);
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
   * @param  \App\Models\HorsePassport  $horsePassport
   * @return \Illuminate\Http\Response
   */
  public function show(HorsePassport $horsePassport)
  {
        //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\HorsePassport  $horsePassport
   * @return \Illuminate\Http\Response
   */
  public function edit(HorsePassport $horsePassport)
  {
        //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\HorsePassport  $horsePassport
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, HorsePassport $horsePassport)
  {
        //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\HorsePassport  $horsePassport
   * @return \Illuminate\Http\Response
   */
  public function destroy(HorsePassport $horsePassport)
  {
        //
  }
}
