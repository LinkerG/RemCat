<?php

namespace App\Helpers;

class CalcSeason
{
    public static function calculate()
    {
        // Para calcular el año
        $currentYear = date('Y');
        $currentDate = date('Y-m-d');
        
        if (date('m', strtotime($currentDate)) < 9){
            $seasonName = (intval(substr($currentYear, -2)) - 1) . "_" . intval(substr($currentYear, -2));
        } else {
            $seasonName = intval(substr($currentYear, -2)) . "_" . (intval(substr($currentYear, -2)) + 1);
        }

        return $seasonName;
    }
}
