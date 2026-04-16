<?php

class Quiz extends Session
{

    public $_id;
    public $_type;
    public $_submissions_max;


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
    }

    function getForm(){
        $data = GFAPI::get_form( $this->id );
        return $data;
    }

    function getFormQuestions(){
       $data = $this->getForm($this->id);
       $data = $data['fields'];
        return $data;
    }

    function countFormQuizItems(){
        $arr = $this->getFormQuestions($this->id);
        $cpt=0;
        for($i=0; $i<count($arr); $i++){
            if($arr[$i]['type'] == 'quiz'){
                $cpt++;
            } 
        }  
        return $cpt;     
    }

    function getFormEntries(){
        $start = microtime(true);
        $paging = array( 'offset' => 0, 'page_size' => 60000 );
        $search_criteria = array( 'status' => 'active' );
        $data = GFAPI::get_entries( $this->id, $search_criteria, null, $paging );
        return $data;
    }

    function countUserFormEntries($userid, $userEval, $userSession){
        $cpt=0;
        $arr = $this->getFormEntries($this->id);
        for($i=0; $i < count($arr); $i++)
        {
            // $arr[$i][4] -> Correspondance avec ID de l'user
            // $arr[$i][5] -> Correspondance avec ID de la session
            // $arr[$i][8] -> Correspondance avec l'eval de l'user (1 = pre ou 2 = post)
            if( ($arr[$i][4] == $userid) && ($arr[$i][8] == $userEval) && ($arr[$i][5] == $userSession) ){
                $cpt++;
            } 
        }  
        return $cpt; 
    }

    function getUserFormEntryDate($userid, $userEval, $userSession){
        $date=0;
        $arr = $this->getFormEntries($this->id);
        $arr = array_reverse($arr);

        for($i=0; $i < count($arr); $i++)
        {
            // $arr[$i][4] -> Correspondance avec ID de l'user
            // $arr[$i][5] -> Correspondance avec ID de la session
            // $arr[$i][8] -> Correspondance avec l'eval de l'user (1 = pre ou 2 = post)
            if( ($arr[$i][4] == $userid) && ($arr[$i][8] == $userEval) && ($arr[$i][5] == $userSession) ){  
                $date = $arr[$i]['date_created'];
            } 
        }  
        return $date; 
    }

    function getUserFormDuration($userid, $userEval, $userSession){
        $cpt=0;
        $arr = $this->getFormEntries($this->id);
        for($i=0; $i < count($arr); $i++)
        {
            // $arr[$i][4] -> Correspondance avec ID de l'user
            // $arr[$i][5] -> Correspondance avec ID de la session
            // $arr[$i][8] -> Correspondance avec l'eval de l'user (1 = pre ou 2 = post)
            if( ($arr[$i][4] == $userid) && ($arr[$i][8] == $userEval) && ($arr[$i][5] == $userSession) ){
                    if(is_numeric($arr[$i]['session_count']))
                    $cpt += $arr[$i]['session_count'];
                    if(is_numeric($arr[$i][35]))
                    $cpt += $arr[$i][35];
                    if(is_numeric($arr[$i][36]))
                    $cpt += $arr[$i][36];
                    if(is_numeric($arr[$i][43]))
                    $cpt += $arr[$i][43];
                    if(is_numeric($arr[$i][20]))
                    $cpt += $arr[$i][20];
            }             
        }        
        return $cpt;
    }


}