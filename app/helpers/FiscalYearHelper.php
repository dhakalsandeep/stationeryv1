<?php

namespace App\helpers;

use App\FiscalYear;

class FiscalYearHelper
{
    public function get_active_fiscal_year() {
       return $fiscal_year = FiscalYear::where('status',1)->first();
    }
}
