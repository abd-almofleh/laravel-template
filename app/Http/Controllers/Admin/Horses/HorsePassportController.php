<?php

namespace App\Http\Controllers\Admin\Horses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Horses\Passports\StoreHorsePassportRequest;
use App\Http\Requests\Admin\Horses\Passports\UpdateHorsePassportRequest;
use App\Models\HorsePassport;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use App\http\Requests\Admin\Horses\Passports\UpdateHorsePassportStatusRequest;
use Exception;
use Toastr;

class HorsePassportController extends Controller
{
  /**
   * If you're not logged in, you can't do anything. If you are logged in, you can only do things if
   * you have the right permissions.
   */
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('permission:horsePassport-list', ['only' => ['index']]);
    $this->middleware('permission:horsePassport-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:horsePassport-edit', ['only' => ['edit', 'update', 'updateStatus']]);
  }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = HorsePassport::get();
      return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            if (Auth::user()->can('horsePassport-edit')) {
              return '<a href="' . route('horses.passports.edit', $row->id) . '" class="custom-edit-btn mr-1">
                              <i class="fe fe-pencil"></i> ' . __('default.form.edit-button') . '
                          </a>';
            } else {
              return '';
            }
          })

          ->addColumn('status', function ($row) {
            if ($row->status == 1) {
              $current_status = 'Checked';
            } else {
              $current_status = '';
            }

            $status = "<input type='checkbox' id='status_$row->id' id='category-$row->id' class='check' onclick='changeHorsesPassportStatus(event.target, $row->id);' " . $current_status . ">
                              <label for='status_$row->id' class='checktoggle'>checkbox</label>";
            return $status;
          })

          ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
          ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
          ->escapeColumns([])
          ->make(true);
    }
    return view('admin.horses.passports.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.horses.passports.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreHorsePassportRequest $request)
  {
    $input = $request->validated();
    try {
      HorsePassport::create($input);
      Toastr::success(__('horsesPassport.message.store.success'));
      return redirect()->route('horses.passports.index');
    } catch (Exception $e) {
      Toastr::error(__('horsesPassport.message.store.error'));
      return redirect()->route('horses.passports.index');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\HorsePassport  $passport
   * @return \Illuminate\Http\Response
   */
  public function edit(HorsePassport $passport)
  {
    return view('admin.horses.passports.edit', compact('passport'));
  }

  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HorsePassport  $horsePassport
     * @return \Illuminate\Http\Response
     */
  public function update(UpdateHorsePassportRequest $request, HorsePassport $passport)
  {
    $input = $request->validated();

    try {
      $passport->update($input);
      Toastr::success(__('horsesType.message.update.success'));
      return redirect()->route('horses.passports.index');
    } catch (Exception $e) {
      Toastr::error(__('horsestype.message.update.error'));
      return redirect()->route('horses.passports.index');
    }
  }

  public function updateStatus(UpdateHorsePassportStatusRequest $request, HorsePassport $passport)
  {
    $input = $request->validated();
    try {
      $passport->update($input);
      return response()->json(['status' => 'success', 'message' => __('horsesPassport.message.update.success')]);
    } catch (Exception $e) {
      return response()->json(['status' => 'failed', 'message' => __('horsesPassport.message.update.error')]);
    }
  }
}
