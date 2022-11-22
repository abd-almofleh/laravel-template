<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\HorsePassport;
use App\Models\HorseType;
use App\Models\ListedHorse;
use App\Models\ListedHorsesOrder;
use Illuminate\Database\Eloquent\Builder;

class ListedHorsesService
{
  public function get_listed_horses_list($filters)
  {
    $query = ListedHorse::query();

    if ($filters['query'] !== false) {
      $query->whereRaw('UPPER(`name`) LIKE ?', ['%' . strtoupper($filters['query']) . '%'])
      ->orWhereHas('passport', function (Builder $q) use ($filters) {
        $q->whereRaw('UPPER(`name_ar`) LIKE ?', ['%' . strtoupper($filters['query']) . '%']);
        $q->orWhereRaw('UPPER(`name_en`) LIKE ?', ['%' . strtoupper($filters['query']) . '%']);
      });
    }

    if ($filters['sex'] !== false) {
      $query->where('sex', $filters['sex']);
    }

    if ($filters['max_birth_year'] !== false && ['min_birth_year'] !== false) {
      $query->where('birth_year', '>=', ['min_birth_year'])->where('birth_year', '<=', $filters['max_birth_year']);
    }

    if ($filters['min_height'] !== false && $filters['max_height'] !== false) {
      $query->where('height', '>=', $filters['min_height'])->where('height', '<=', ['max_height']);
    }

    if ($filters['color'] !== false) {
      $query->whereRaw('UPPER(`color`) LIKE ?', ['%' . strtoupper($filters['color']) . '%']);
    }

    if ($filters['type'] !== false) {
      $query->where('type_id', $filters['type']);
    }
    if ($filters['passport'] !== false) {
      $query->where('passport_type_id', $filters['passport']);
    }
    $data = $query->paginate();
    return $data;
  }

  public function get_recent_listed_horses_list(int $count)
  {
    $query = ListedHorse::query();
    $query->orderBy('created_at', 'desc')
    ->limit($count);
    $data = $query->get();

    return $data;
  }

  public function get_filter_options()
  {
    $options = [];
    $options['horsesCategories'] = HorseType::select(['id', 'name_en', 'name_ar'])->active()->get();
    $options['horsesPassports'] = HorsePassport::select(['id', 'name_en', 'name_ar'])->active()->get();
    $options['sex'] = ['male'=>1, 'female'=> 0];

    return $options;
  }

  public function order_horse(ListedHorse $listedHorse, Customer $customer, string $phone_number)
  {
    $listedHorse->load('order');

    if ($listedHorse->order !== null) {
      abort(404, __('listedHorses.not_found'));
    }

    ListedHorsesOrder::create([
      'status'          => config('constants.order_status.pending'),
      'customer_id'     => $customer->id,
      'listed_horse_id' => $listedHorse->id,
      'phone_number'    => $phone_number,
    ]);
  }
}
