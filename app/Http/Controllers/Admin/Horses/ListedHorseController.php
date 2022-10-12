<?php

namespace App\Http\Controllers\Admin\Horses;

use App\Http\Controllers\Controller;
use App\Models\Horse;
use Auth;
use DataTables;
use Illuminate\Http\Request;

class ListedHorseController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('permission:horse-list', ['only' => ['index']]);
    $this->middleware('permission:horse-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:horse-edit', ['only' => ['edit', 'update', 'updateStatus']]);
    $this->middleware('permission:horse-show', ['only' => ['show']]);
    $this->middleware('permission:horse-delete', ['only' => ['destroy']]);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->ajax()) {
        $data = Horse::with(['type' => function ($query) {
          $query->select(['id', 'name']);
        }])->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
              if (Auth::user()->can('horses-show')) {
                $view = '<a href="' . route('horses.listed-horses.show', $row->id) . '" class="custom-view-btn mr-1">
                                    <i class="fe fe-eye"></i> ' . __('default.form.view-button') . '
                                </a>';
              } else {
                $view = '';
              }
              if (Auth::user()->can('horses-edit')) {
                $edit = '<a href="' . route('horses.listed-horses.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i> ' . __('default.form.edit-button') . '
                                </a>';
              } else {
                $edit = '';
              }

              if (Auth::user()->can('horses-delete')) {
                $delete = '<button class="custom-delete-btn remove-listed-horse" data-id="' . $row->id . '" data-action="' . route('horses.listed-horses.destroy', $row->id) . '">
            <i class="fe fe-trash"></i> ' . __('default.form.delete-button') . '
          </button>';
              } else {
                $delete = '';
              }
              return $view . ' ' . $edit . ' ' . $delete;
            })
            ->addColumn('type', function ($row) {
              return  $row->type->name;
            })
            ->addColumn('is_deleted', function ($row) {
              return  $row->deleted_at === null ? __('default.no') : __('default.yes');
            })

            ->addColumn('sex_text', function ($row) {
              return $row->sex == config('constants.sex.male') ? __('default.sex.male') : __('default.sex.female');
            })

            ->editColumn('created_at', '{{date("jS M Y", strtotime($created_at))}}')
            ->editColumn('updated_at', '{{date("jS M Y", strtotime($updated_at))}}')
            ->escapeColumns([])
            ->make(true);
      }
      return view('admin.horses.listed-horses.index');
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
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(Horse $horse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(Horse $horse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horse $horse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horse $horse)
    {
        //
    }
}
