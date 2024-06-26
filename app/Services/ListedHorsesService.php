<?php

namespace App\Services;

use App\Enums\HorseGender;
use App\Models\Customer;
use App\Models\HorsePassport;
use App\Models\HorseType;
use App\Models\ListedHorse;
use App\Models\ListedHorsesOrder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ListedHorsesService
{
  /**
   * I want to filter the results of the query based on the filters that are passed to the function
   *
   * @param filters array
   *
   * @return LengthAwarePaginator A LengthAwarePaginator object.
   */
  public function get_listed_horses_list(array $filters): LengthAwarePaginator
  {
    $query = ListedHorse::query()->available();
    if ($filters['query'] !== null && $filters['query'] !== false) {
      $query->whereRaw('UPPER(`name`) LIKE ?', ['%' . strtoupper($filters['query']) . '%'])
      ->orWhereHas('passport', function (Builder $q) use ($filters) {
        $q->whereRaw('UPPER(`name_ar`) LIKE ?', ['%' . strtoupper($filters['query']) . '%']);
        $q->orWhereRaw('UPPER(`name_en`) LIKE ?', ['%' . strtoupper($filters['query']) . '%']);
      });
    }

    if ($filters['gender'] !== null && $filters['gender'] !== false) {
      $query->where('gender', $filters['gender']);
    }

    if ($filters['max_birth_year'] !== null && $filters['max_birth_year'] !== false) {
      $query->where('birth_year', '<=', $filters['max_birth_year']);
    }

    if ($filters['min_birth_year'] !== null && $filters['min_birth_year'] !== false) {
      $query->where('birth_year', '>=', $filters['min_birth_year']);
    }

    if ($filters['min_height'] !== null && $filters['min_height'] !== false) {
      $query->where('height', '>=', $filters['min_height']);
    }

    if ($filters['max_height'] !== null && $filters['max_height'] !== false) {
      $query->where('height', '<=', $filters['max_height']);
    }

    if ($filters['color'] !== null && $filters['color'] !== false) {
      $query->whereRaw('UPPER(`color`) LIKE ?', ['%' . strtoupper($filters['color']) . '%']);
    }

    if ($filters['type'] !== null && $filters['type'] !== false) {
      $query->where('type_id', $filters['type']);
    }
    if ($filters['passport'] !== null && $filters['passport'] !== false) {
      $query->where('passport_type_id', $filters['passport']);
    }

    $data = $query->paginate(15);

    return $data;
  }

  /**
   * Get the most recent listed horses from the database.
   *
   * @param int count The number of horses to return
   *
   * @return Collection A collection of ListedHorse models.
   */
  public function get_recent_listed_horses_list(int $count): Collection
  {
    $data = ListedHorse::available()->recent($count)->get();

    return $data;
  }

  /**
   * It returns an array of arrays of objects
   */
  public function get_filter_options()
  {
    $options = [];
    $options['horsesCategories'] = HorseType::active()->get();

    foreach ($options['horsesCategories'] as $value) {
      $value->makeHidden(['name_ar', 'name_en', 'photo']);
    }

    $options['horsesPassports'] = HorsePassport::active()->get();
    foreach ($options['horsesPassports'] as $value) {
      $value->makeHidden(['name_ar', 'name_en']);
    }

    $options['gender'] = [];
    foreach (HorseGender::values() as $value) {
      $options['gender'][$value] = __("default.gender.$value");
    }

    return $options;
  }

  public function get_types()
  {
    $types = HorseType::active()->get();

    return $types;
  }

  /**
   * It creates a new order for a listed horse
   *
   * @param ListedHorse listedHorse This is the horse that the customer is trying to order.
   * @param Customer customer The customer who is ordering the horse
   * @param string phone_number
   */
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
