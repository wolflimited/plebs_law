<?php
    //date validation
    public function validDate($date,$format = 'Y-m-d'){
        $ci =& get_instance();
        $d = DateTime::createFromFormat($format, $date);
        //Check for valid date in given format
            if($d && $d->format($format) == $date){
                return true;
            }else{
                $this->form_validation->set_message('valid_date', 
                    'The %s date is not valid it should match this ('.$format.') format');
                return false;
            }
    }