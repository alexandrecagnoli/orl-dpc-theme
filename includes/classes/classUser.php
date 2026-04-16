<?php

class User
{

    public $_id;
    public $_firstname;
    public $_lastname;
    public $_email;
    public $_city;
    public $_zipcode;
    public $_address1;
    public $_address2;
    public $_type;
    public $_birthdate;
    public $_RPPS;
    public $_phone;
    public $_mobile;
    public $_optin;
    public $_paycheck_limit;


    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this , $f),$a);
        }
    }

    function __construct1($a1)
    {

        $this->id = ($a1);
        $user_info = get_userdata($this->id);
        $this->firstname = $user_info->first_name;
        $this->lastname = $user_info->last_name;
        $this->email = $user_info->user_email;
        $this->city = get_field('member_city', "user_".$this->id );
        $this->zipcode = get_field('member_zipcode', "user_".$this->id );
        $this->address1 = get_field('member_address_1', "user_".$this->id );
        $this->address2 = get_field('member_address_2', "user_".$this->id );
        $this->type = get_field('member_situation', "user_".$this->id );
        $this->birthdate = get_field('member_birthdate', "user_".$this->id );
        $this->RPPS = get_field('member_rpps', "user_".$this->id );
        $this->phone = get_field('member_phone', "user_".$this->id );
        $this->mobile = get_field('member_mobile', "user_".$this->id );
        $this->optin = get_field('member_optin', "user_".$this->id );


        if( !empty(get_field('member_paycheck_limit', "user_".$this->id)))
        {
            $this->paycheck_limit = get_field('member_paycheck_limit', "user_".$this->id );
        }
        else
        {
            $this->paycheck_limit = 0;
        }


    }

    function paycheck_IsValid()
    {
        if($this->paycheck_limit == 0)
        {
            return 0;
        }
        else
        {
            //$timestamp = strtotime($this->paycheck_limit);
            $timestamp = DateTime::createFromFormat('d/m/Y', $this->paycheck_limit);
            $timestamp=$timestamp->format('U');
            $ct=time();
            if( $timestamp > time() )
            {
               return 2;
            }
            else
            {
                return 1;
            }
        }
    }


}
