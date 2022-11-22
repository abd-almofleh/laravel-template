<?php

namespace App\Http\Controllers\Admin\Horses;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Admin\Horses\ListedHorses\StoreListedHorseRequest;
use App\Http\Requests\Admin\Horses\ListedHorses\UpdateListedHorseRequest;
use App\Models\ListedHorse;
use App\Models\HorsePassport;
use App\Models\HorseType;
use Auth;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Toastr;

class ListedHorseController extends Controller
{
  use MediaUploadingTrait;

  public function __construct()
  {
    $this->middleware('auth:admin');
    $this->middleware('permission:listedHorses:list,admin', ['only' => ['index']]);
    $this->middleware('permission:listedHorses:create,admin', ['only' => ['create', 'store']]);
    $this->middleware('permission:listedHorses:edit,admin', ['only' => ['edit', 'update', 'updateStatus']]);
    $this->middleware('permission:listedHorses:show,admin', ['only' => ['show']]);
    $this->middleware('permission:listedHorses:delete,admin', ['only' => ['destroy']]);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->ajax()) {
        $data = ListedHorse::withTrashed()->get();
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
              if (Auth::user()->can('horses-edit') && $row->deleted_at === null) {
                $edit = '<a href="' . route('horses.listed-horses.edit', $row->id) . '" class="custom-edit-btn mr-1">
                                    <i class="fe fe-pencil"></i> ' . __('default.form.edit-button') . '
                                </a>';
              } else {
                $edit = '';
              }

              if (Auth::user()->can('horses-delete') && $row->deleted_at === null) {
                $delete = '<button class="custom-delete-btn remove-listed-horse" data-id="' . $row->id . '" data-action="' . route('horses.listed-horses.destroy', $row->id) . '">
            <i class="fe fe-trash"></i> ' . __('default.form.delete-button') . '
          </button>';
              } else {
                $delete = '';
              }
              return $view . ' ' . $edit . ' ' . $delete;
            })
            ->addColumn('type', function ($row) {
              return  $row->type->name_en;
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
      $horsesTypes = HorseType::active()->get();
      $horsesPassports = HorsePassport::active()->get();

      return view('admin.horses.listed-horses.create', compact('horsesTypes', 'horsesPassports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListedHorseRequest $request)
    {
      $input = $request->except(['videos', 'photos']);
      $photos = $request->input('photos', []);
      $videos = $request->input('videos', []);
      try {
        $listedHorse = ListedHorse::create($input);
        foreach ($photos as $photo) {
          $listedHorse->addMedia(storage_path('tmp/uploads/' . basename($photo)))->toMediaCollection('photos');
        }
        foreach ($videos as $video) {
          $listedHorse->addMedia(storage_path('tmp/uploads/' . basename($video)))->toMediaCollection('videos');
        }
        Toastr::success(__('listedHorses.message.store.success'));
        return redirect()->route('horses.listed-horses.index');
      } catch (Exception $e) {
        return $e->getMessage();
        Toastr::error(__('listedHorses.message.store.error'));
        return redirect()->back()->withInput();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListedHorse   $listedHorse
     * @return \Illuminate\Http\Response
     */
    public function show(ListedHorse $listedHorse)
    {
      return view('admin.horses.listed-horses.show', compact('listedHorse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListedHorse   $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(ListedHorse $listedHorse)
    {
      $horsesTypes = HorseType::active()->orWhere('id', $listedHorse->type_id)->get();
      $horsesPassports = HorsePassport::active()->orWhere('id', $listedHorse->passport_type_id)->get();

      return view('admin.horses.listed-horses.edit', compact('listedHorse', 'horsesTypes', 'horsesPassports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListedHorse   $listedHorse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateListedHorseRequest $request, ListedHorse $listedHorse)
    {
      $listedHorse->update($request->validated());
      if ($request->input('photos', false)) {
        $photos = $listedHorse->photos->toArray();
        $newPhotos = $request->photos;
        $toDelete = [];
        for ($i = 0; $i < count($photos); $i++) {
          if (($key = array_search($photos[$i]['file_name'], $newPhotos)) === false) {
            array_push($toDelete, $photos[$i]['id']);
          } else {
            unset($newPhotos[$key]);
          }
        }
        Media::whereIn('id', $toDelete)->delete();
        $newPhotos = array_values($newPhotos);

        foreach ($newPhotos as $photo) {
          $listedHorse->addMedia(storage_path('tmp/uploads/' . basename($photo)))->toMediaCollection('photos');
        }
      }
      if ($request->input('videos', false)) {
        $videos = $listedHorse->videos->toArray();
        $newVideos = $request->videos;
        $toDelete = [];
        for ($i = 0; $i < count($videos); $i++) {
          if (($key = array_search($videos[$i]['file_name'], $newVideos)) === false) {
            array_push($toDelete, $videos[$i]['id']);
          } else {
            unset($newVideos[$key]);
          }
        }
        Media::whereIn('id', $toDelete)->delete();
        $newVideos = array_values($newVideos);

        foreach ($newVideos as $video) {
          $listedHorse->addMedia(storage_path('tmp/uploads/' . basename($video)))->toMediaCollection('videos');
        }
      }
      Toastr::success(__('listedHorses.message.update.success'));

      return redirect()->route('horses.listed-horses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListedHorse   $listedHorse
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListedHorse $listedHorse)
    {
      $listedHorse->delete();

      Toastr::success(__('listedHorses.message.destroy.success'));

      return redirect()->route('horses.listed-horses.index');
    }
}
