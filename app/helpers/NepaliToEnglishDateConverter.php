<?php
namespace App\helpers;

class NepaliToEnglishDateConverter
{
    public function nep_to_eng_date_converter($nep_date) {
        $date_array = explode('-',$nep_date);

        $bsObj = new DateHelper();
        $data_ad_array = $bsObj->nep_to_eng($date_array[0],$date_array[1],$date_array[2]);
        $data_ad_array['month'] = $this->format_month_date($data_ad_array['month']);
        $data_ad_array['date'] = $this->format_month_date($data_ad_array['date']);
        $eng_date = $data_ad_array['year'] .'-'. $data_ad_array['month'] .'-'.$data_ad_array['date'];
        return $eng_date;
    }

    public function nep_date_formatter($nep_date) {
        $date_array = explode('-',$nep_date);
        $date_array[1] = $this->format_month_date($date_array[1]);
        $date_array[2] = $this->format_month_date($date_array[2]);
        $formatted_nep_date = $date_array[0] .'-'. $date_array[1] .'-'.$date_array[2];
//        dd($formatted_nep_date);
        return $formatted_nep_date;
    }



    public function format_month_date($num) {
        return strlen($num) == 1 ? '0'.$num : $num ;
    }
}
