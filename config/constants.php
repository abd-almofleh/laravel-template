<?php

return [
  'blogs'            => ['status'=>['published' => 1, 'draft' => 0]],
  'horse_birth_year' => ['start' => 2000, 'end' => intval(date('Y'))],
  'order_status'     => [
    'pending'  => 'pending',
    'finished' => 'finished',
    'canceled' => 'canceled',
  ],
];
