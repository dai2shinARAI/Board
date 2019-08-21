<?php

namespace MyApp\Exception;

class DuplicateUsername extends \Exception {
  protected $message = 'Duplicate Username!';
}
