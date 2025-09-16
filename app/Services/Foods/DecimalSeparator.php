<?php

namespace App\Services\Foods;

class DecimalSeparator {
    public function changeDecimalToValidate(array $values): array{

        $values['quantity'] = str_replace(",", ".", $values['quantity']);
        $values['energy_value'] = str_replace(",", ".", $values['energy_value']);
        $values['carbohydrates'] = str_replace(",", ".", $values['carbohydrates']);
        $values['sugars'] = str_replace(",", ".", $values['sugars']);
        $values['proteins'] = str_replace(",", ".", $values['proteins']);
        $values['fats'] = str_replace(",", ".", $values['fats']);
        $values['dietary_fiber'] = str_replace(",", ".", $values['dietary_fiber']);
        $values['sodium'] = str_replace(",", ".", $values['sodium']);
        $values['other'] = str_replace(",", ".", $values['other']);

        return $values;
    }
}
