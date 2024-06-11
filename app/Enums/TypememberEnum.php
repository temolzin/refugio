<?php
namespace App\Enums;

enum TypememberEnum: string
{
  case ADOPTER = 'Adoptante';
  case DONOR = 'Donante';
  case GODFATHER = 'Padrino';
  case STAFF = 'Personal';

  public function value(): string {
    return $this->value;
}
}
