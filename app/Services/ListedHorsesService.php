<?php

namespace App\Services;

use App\Models\HorsePassport;
use App\Models\HorseType;
use App\Models\ListedHorse;

class ListedHorsesService
{
  public function get_listed_horses_list($filters)
  {
    $query = ListedHorse::query();

    if ($filters['name'] !== false) {
      $query->whereRaw('UPPER(`name`) LIKE ?', ['%' . strtoupper($filters['name']) . '%']);
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
      $query->where('type_id', ['type']);
    }
    if ($filters['passport'] !== false) {
      $query->where('passport_type_id', ['passport']);
    }
    $data = $query->paginate();
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

  public function order_horse(ListedHorse $listedHorse, $customer, string $phone_number)
  {
    return false;
  }
}
