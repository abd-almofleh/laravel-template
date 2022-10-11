<?php

namespace App\Http\Controllers\Admin\Horses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Horses\Types\StoreHorseTypeRequest;
use App\Http\Requests\Admin\Horses\Types\updateHorseTypeRequest;
use App\Models\HorseType;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Toastr;

class HorseTypeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('permission:horseType-list', ['only' => ['index']]);
    $this->middleware('permission:horseType-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:horseType-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:horseType-delete', ['only' => ['destroy']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = HorseType::get();
      return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            if (Auth::user()->can('horseType-edit')) {
              $edit = '<a href="' . route('horses.types.edit', $row->id) . '" class="custom-edit-btn mr-1">
                        <i class="fe fe-pencil"></i> ' . __('default.form.edit-button') . '
                    </a>';
            } else {
              $edit = '';
            }
            return $edit;
          })

          ->addColumn('status', function ($row) {
            if ($row->status == 1) {
              $current_status = 'Checked';
            } else {
              $current_status = '';
            }

            $status = "<input type='checkbox' id='status_$row->id' id='category-$row->id' class='check' onclick='changeHorseTypeStatus(event.target, $row->id);' " . $current_status . ">
                        <label for='status_$row->id' class='checktoggle'>checkbox</label>";
            return $status;
          })

          ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
          ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
          ->escapeColumns([])
          ->make(true);
    }
    return view('admin.horses.types.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.horses.types.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreHorseTypeRequest $request)
  {
    $input = $request->validated();
    // dd($input);
    try {
      HorseType::create($input);
      Toastr::success(__('horsesType.message.store.success'));
      return redirect()->route('horses.types.index');
    } catch (Exception $e) {
      Toastr::error(__('horsestype.message.store.error'));
      return redirect()->route('horses.types.index');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\HorseType  $type
   * @return \Illuminate\Http\Response
   */
  public function edit(HorseType $type)
  {
    return view('admin.horses.types.edit', compact('type'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\HorseType  $type
   * @return \Illuminate\Http\Response
   */
  public function update(updateHorseTypeRequest $request, HorseType $type)
  {
    $input = $request->validated();

    try {
      $type->update($input);
      Toastr::success(__('horsesType.message.update.success'));
      return redirect()->route('horses.types.index');
    } catch (Exception $e) {
      Toastr::error(__('horsestype.message.update.error'));
      return redirect()->route('horses.types.index');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\HorseType  $horseType
   * @return \Illuminate\Http\Response
   */
  public function destroy(HorseType $horseType)
  {
        //
  }
}
