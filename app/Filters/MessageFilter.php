<?php

namespace App\Filters;

class MessageFilter extends QueryFilter {

  public function message($message = null) {
    $message = urldecode($message);
    return $this->builder->when($message, function($query) use($message) {
      $query->where('message', 'LIKE', "%{$message}%");
    });
  }



}
