<?php


/**
 * Description of Globals
 *
 * @author sharon
 */
class Globals extends CApplicationComponent{
    
    function convertDate($date)
    {
        $newDate = "";
        
        if (!$date == "")
        {
            $day = substr($date, 0,2);
            $month = substr($date, 3,2);
            $year = substr($date,6,4);
            
            $newDate = $year."-".$month."-".$day;
            
            
            
        }
        
        return $newDate;
    }
    
    function parseParameters($parameters_array)
    {
        $pars_array = isset($parameters_array) ? CJSON::decode($parameters_array): "";
        
        $ids = "";
        $conditions = "";
        $count = count($pars_array);
        if ($count > 0)
        {
            foreach ($pars_array as $fk_field => $pars)
            {
                $i = 0;
                $ids = "";
                $inner_count = count($pars);
                
                    foreach ($pars as  $par)
                    {
                        if ($inner_count == 1 || ($inner_count-1) == $i)
                        {
                            $ids .= $par['id'];
                        }
                        else
                        {
                            $ids .= $par['id'].",";
                        }
                        
                        $i++;
                    }
                if (!$ids == "")
                {
                    $conditions .= " AND $fk_field IN($ids)";
                }
            }
        }
        return $conditions;
    }
}

?>
