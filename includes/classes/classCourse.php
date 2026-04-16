<?php

class Course
{

    public $_id;
    public $_course_id;
    public $_startdate;
    public $_location;
    public $_city;
    public $_address;
    public $_location_img;
    public $_duration;
    public $_capacity;
    public $_dpc_id;
    public $_venue_subway;
    public $_venue_bus;
    public $_venue_tram;
    public $_venue_rer;
    public $_location_map;
    public $_program;

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
        $this->course_id = get_field('session_course', $this->id );
/*
        $t = $this->get_status_meta();
        $contributor_info = get_userdata($this->id);
        $this->login = $contributor_info->user_login;
        $this->firstname = $contributor_info->first_name;
        $this->lastname = $contributor_info->last_name;
        $this->description = $contributor_info->description;
*/
        $this->startdate = get_field('session_startdate', $this->id );
        $this->location = get_field('session_location', $this->id );
        $this->city = get_field('session_city', $this->id );
        $this->address = get_field('session_address', $this->id );
        $this->location_img = get_field('session_location_img', $this->id );
        $this->duration = get_field('session_duration', $this->id );
        $this->capacity = get_field('session_capacity', $this->id );
        $this->dpc_id = get_field('session_dpc_id', $this->id );
        $this->venue_subway = get_field('session_venue_subway', $this->id );
        $this->venue_bus = get_field('session_venue_bus', $this->id );
        $this->venue_tram = get_field('session_venue_tram', $this->id );
        $this->venue_rer = get_field('session_venue_rer', $this->id );
        $this->location_map = get_field('session_location_map', $this->id );
        $this->program = get_field('session_program', $this->id ); 
    }
}