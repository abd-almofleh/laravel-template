<?php

namespace App\Http\Controllers\Admin\Horses;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\Horses\Types\StoreHorseTypeRequest;
use App\Models\HorseType;
use Auth;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Toastr;
use App\http\Requests\Admin\Horses\Types\UpdateHorseTypeStatusRequest;
use App\http\Requests\Admin\Horses\Types\UpdateHorseTypeRequest;

class HorseTypeController extends Controller
{
  use MediaUploadingTrait;

  public function __construct()
  {
    $this->middleware('auth:admin');
    $this->middleware('permission:horseType-list,admin', ['only' => ['index']]);
    $this->middleware('permission:horseType-create,admin', ['only' => ['create', 'store']]);
    $this->middleware('permission:horseType-edit,admin', ['only' => ['edit', 'update', 'updateStatus']]);
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
          ->addColumn('image_preview', function ($row) {
            if ($row->photo) {
              $image = '<img class="w-100" style="max-width: 100px" src="' . $row->photo->fullUrl . '" />';
            } else {
              $image = 'Image not found';
            }
            return $image;
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
    try {
      $type = HorseType::create($input);
      if ($request->input('photo', false)) {
        $type->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photos');
      }

      Toastr::success(__('horsesType.message.store.success'));
      return redirect()->route('horses.types.index');
    } catch (Exception $e) {
      Toastr::error(__('horsesType.message.store.error'));
      return redirect()->route('horses.types.index');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\HorseType     $type
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
   * @param  \App\Models\HorseType     $type
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateHorseTypeRequest $request, HorseType $type)
  {
    $input = $request->validated();

    try {
      $type->update($input);
      if ($request->input('photo', false)) {
        if (!$type->photo || $request->input('photo') !== $type->photo->file_name) {
          if ($type->photo) {
            $type->photo->delete();
          }
          $type->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photos');
        }
      } elseif ($type->photo) {
        $type->photo->delete();
      }

      Toastr::success(__('horsesType.message.update.success'));
      return redirect()->route('horses.types.index');
    } catch (Exception $e) {
      Toastr::error(__('horsestype.message.update.error'));
      return redirect()->route('horses.types.index');
    }
  }

  public function updateStatus(UpdateHorseTypeStatusRequest $request, HorseType $type)
  {
    $input = $request->validated();

    try {
      $type->update($input);
      return response()->json(['status' => 'success', 'message' => __('horsestype.message.update.success')]);
    } catch (Exception $e) {
      return response()->json(['status' => 'failed', 'message' => __('horsestype.message.update.error')]);
    }
  }
}
