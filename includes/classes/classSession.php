<?php

class Session
{

    public $_id;
    public $_type;
    public $_accreditation;
    public $_conference_link;
    public $_conference_id;
    public $_conference_password;
    public $_course_id;
    public $_startdate;
    public $_enddate;
    public $_moment;
    public $_location;
    public $_city;
    public $_zipcode;
    public $_address;
    public $_location_img;
    public $_duration;
    public $_capacity;
    public $_session_id;
    public $_dpc_id;
    public $_indemnisation;
    public $_venue_subway;
    public $_venue_bus;
    public $_venue_tram;
    public $_venue_rer;
    public $_venue_train;
    public $_venue_airport;
    public $_venue_parking;
    public $_venue_taxi;
    public $_location_map;
    public $_program;

    public $_evaluation_type;
    public $_app_number;
    public $_epp_number;
    public $_epp_form;
    public $_app_form;
    public $_eval_1;
    public $_eval_1_startdate;
    public $_eval_1_enddate;
    public $_eval_2;
    public $_eval_2_startdate;
    public $_eval_2_enddate;

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
        $this->type = get_field('session_type', $this->id );
        $this->accreditation = get_field('session_accreditation', $this->id );
        $this->conference_link = get_field('session_visioconference', $this->id );
        $this->conference_id = get_field('session_visioconference_id', $this->id );
        $this->conference_password = get_field('session_visioconference_password', $this->id );
        $this->startdate = get_field('session_startdate', $this->id );
        $this->enddate = get_field('session_enddate', $this->id );
        $this->starttime = get_field('session_starttime', $this->id );
        $this->endtime = get_field('session_endtime', $this->id );
        $this->moment = get_field('session_moment', $this->id ); // matin / apres midi / soirée / journée complète
        $this->location = get_field('session_location', $this->id );
        $this->city = get_field('session_city', $this->id );
        if( $this->type == 1 ) { $this->city = "Webinar";}
        $this->zipcode = get_field('session_zipcode', $this->id );
        $this->address = get_field('session_address', $this->id );
        $this->location_img = get_field('session_location_img', $this->id );
        $this->duration = get_field('session_duration', $this->id );
        $this->capacity = get_field('session_capacity', $this->id );
        $this->session_id = get_field('session_id', $this->id );
        $this->dpc_id = get_field('session_dpc_id', $this->id );
        $this->indemnisation = get_field('session_indemnisation', $this->id );
        $this->dpc_number = get_field('session_dpc_number', $this->id );
        $this->venue_subway = get_field('session_venue_subway', $this->id );
        $this->venue_bus = get_field('session_venue_bus', $this->id );
        $this->venue_tram = get_field('session_venue_tram', $this->id );
        $this->venue_rer = get_field('session_venue_rer', $this->id );
        $this->venue_train = get_field('session_venue_train', $this->id );
        $this->venue_airport = get_field('session_venue_airport', $this->id );
        $this->venue_parking = get_field('session_venue_parking', $this->id );
        $this->venue_taxi = get_field('session_venue_taxi', $this->id );
        $this->location_map = get_field('session_location_map', $this->id );
        $this->program = get_field('session_program_item', $this->id );

        $this->evaluation_type = get_field('evaluation_type', $this->id );
        
        $this->epp_number= get_field('epp_number', $this->id );
        $this->app_form = get_field('app_form', $this->id );
        $this->epp_form = get_field('epp_form', $this->id );
        $this->eval_1_startdate = get_field('eval_1_startdate', $this->id );
        $this->eval_1_enddate = get_field('eval_1_enddate', $this->id );
        //$this->eval_2 = get_field('session__eval_2', $this->id );
        $this->eval_2_startdate = get_field('eval_2_startdate', $this->id );
        $this->eval_2_enddate = get_field('eval_2_enddate', $this->id );

    }

    function __construct2($a1 , $a2)
    {

        $this->id = ($a1);
        $this->course_id = $a2;
/*
        $t = $this->get_status_meta();
        $contributor_info = get_userdata($this->id);
        $this->login = $contributor_info->user_login;
        $this->firstname = $contributor_info->first_name;
        $this->lastname = $contributor_info->last_name;
        $this->description = $contributor_info->description;
*/
        $this->type = get_field('session_type', $this->id );
        $this->conference_link = get_field('session_visioconference', $this->id );
        $this->conference_id = get_field('session_visioconference_id', $this->id );
        $this->conference_password = get_field('session_visioconference_password', $this->id );
        $this->startdate = get_field('session_startdate', $this->id );
        $this->enddate = get_field('session_enddate', $this->id );
        $this->starttime = get_field('session_starttime', $this->id );
        $this->endtime = get_field('session_endtime', $this->id );
        $this->moment = get_field('session_moment', $this->id ); // matin / apres midi / soirée / journée complète
        $this->location = get_field('session_location', $this->id );
        $this->city = get_field('session_city', $this->id );
        if( $this->type == 1 ) { $this->city = "Webinar";}
        $this->zipcode = get_field('session_zipcode', $this->id );
        $this->address = get_field('session_address', $this->id );
        $this->location_img = get_field('session_location_img', $this->id );
        $this->duration = get_field('session_duration', $this->id );
        $this->capacity = get_field('session_capacity', $this->id );
        $this->session_id = get_field('session_id', $this->id );
        $this->indemnisation = get_field('session_indemnisation', $this->id );
        $this->dpc_id = get_field('session_dpc_id', $this->id );
        $this->venue_subway = get_field('session_venue_subway', $this->id );
        $this->venue_bus = get_field('session_venue_bus', $this->id );
        $this->venue_tram = get_field('session_venue_tram', $this->id );
        $this->venue_rer = get_field('session_venue_rer', $this->id );
        $this->venue_train = get_field('session_venue_train', $this->id );
        $this->venue_airport = get_field('session_venue_airport', $this->id );
        $this->venue_parking = get_field('session_venue_parking', $this->id );
        $this->venue_taxi = get_field('session_venue_taxi', $this->id );
        $this->location_map = get_field('session_location_map', $this->id );
        $this->program = get_field('session_program_item', $this->id );
        $this->eval_1 = get_field('session__eval_1', $this->id );
        $this->eval_1_startdate = get_field('session__eval_1_startdate', $this->id );
        $this->eval_2 = get_field('session__eval_2', $this->id );
        $this->eval_2_startdate = get_field('session__eval_2_startdate', $this->id );
    }

    function getCourseTitle()
    {
        return get_the_title($this->course_id);
    }

    function getCourseContent()
    {
        $content_post = get_post($this->course_id);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
    }

    function getCourseBannerUrl()
    {
        $banner = get_field('course_banner', $this->course_id);
        $banner = $banner['url'];
        return $banner;
    }

    function getCoursePermalink()
    {
        $permalink = get_permalink( $this->course_id );
        return $permalink;
    }

    function getSessionDayName()
    {
       
        $date = new DateTime($this->startdate);
        $date=$date->format('Y-m-d H:i:s');
        setlocale(LC_TIME, "fr_FR");
        $dateDay = utf8_encode(strftime("%A", strtotime($date )));
        switch($dateDay) {
            case "Monday"  : 
            $dateDay = "Lundi";
            break;
            case "Tuesday"  : 
            $dateDay = "Mardi";
            break;
            case "Wednesday"  : 
            $dateDay = "Mercredi";
            break;
            case "Thursday"  : 
            $dateDay = "Jeudi";
            break;
            case "Friday"  : 
            $dateDay = "Vendredi";
            break;
            case "Saturday"  : 
            $dateDay = "Samedi";
            break;
            case "Sunday"  : 
            $dateDay = "Dimanche";
            break;
        }
        return $dateDay;
        //return LC_TIME;
    }
    function getSessionDayNum()
    {
        $date = new DateTime($this->startdate);
        $date = $date->format('d');
        setlocale(LC_TIME, "fr_FR");
        return $date;
    }
    function getSessionMonthName()
    {
        $date = new DateTime($this->startdate);
        $date=$date->format('Y-m-d H:i:s');
        setlocale(LC_TIME, "fr_FR");
        $dateMonth = utf8_encode(strftime("%B", strtotime($date )));
        switch($dateMonth) {
            case "January"  : 
            $dateMonth = "Janvier";
            break;
            case "February"  : 
            $dateMonth = "Février";
            break;
            case "March"  : 
            $dateMonth = "Mars";
            break;
            case "April"  : 
            $dateMonth = "Avril";
            break;
            case "May"  : 
            $dateMonth = "Mai";
            break;
            case "June"  : 
            $dateMonth = "Juin";
            break;
            case "July"  : 
            $dateMonth = "Juillet";
            break;
            case "August"  : 
            $dateMonth = "Aout";
            break;
            case "September"  : 
            $dateMonth = "Septembre";
            break;
            case "April"  : 
            $dateMonth = "Avril";
            break;
            case "October"  : 
            $dateMonth = "Octobre";
            break;
            case "Novembre"  : 
            $dateMonth = "Novembre";
            break;
            case "December"  : 
            $dateMonth = "Décembre";
            break;
        }        
        return $dateMonth;
    }
    function getSessionTypeNiceName()
    {
        $ph = "Présentiel";
        if( $this->type == 1){
            $ph = "Distanciel";
        }
        return $ph;
    }
    function getSessionYear()
    {
        $date = new DateTime($this->startdate);
        $date = $date->format('Y');
        setlocale(LC_TIME, "fr_FR");
        return $date;
    }
    // Compte le nombre de places restantes
    function getSessionCountdown()
    {
        $countdown = $this->capacity - $this->getCustomersCount();
        return $countdown;
    }
    function getSessionCountdownNiceName()
    {
        $countdown = $this->capacity - $this->getCustomersCount();
        if($countdown == 0)
        {
            return "La formation est complète";
        }
        else
        {
           // return ("Date limite d'inscription : ".$this->getSessionSubscriptionLimitNiceDate(). "<br>" . $countdown . " places disponibles" );
           return ("Date limite d'inscription : ".$this->getSessionSubscriptionLimit(). "<br>" . $countdown . " places disponibles" );

        }
    }

    // La date est elle dépassée ?
    function isComing()
    {
        $isComing = true;
        $startdatetime = strtotime($this->startdate);
        
        if($startdatetime < time())
        $isComing=false;
        if(current_user_can('administrator'))
        $isComing=true;
        return $isComing;
    } 
    
    function canParticipate($customer_id){

        $customer = new User($customer_id);

        if(
            // si l'user est inscrit sur MONDPC
            $this->getDPC($customer_id) >= 1 &&
            // si l'user a renvoyé son formulaire d'inscription
            //$mySession->getRegistrationForm($customer_id) >= 1 &&
            // si l'user a un chèque de caution valide
            ( $customer->paycheck_IsValid() >= 2 || $this->type == 1 ) &&
            // si l'inscription de l'user est validée
            $this->getCustomerStatus($customer_id) == 2
           )
            {
                return true;	
            }
    }
    
    // Date limite d'inscription
    function getSessionSubscriptionLimit()
    {
        $timestamp = strtotime( $this->eval_1_startdate);
        $date = wp_date('d-m-Y', $timestamp);
        return $date;
    } 

    // Date limite d'inscription
    function getSessionSubscriptionLimitNiceDate()
    {
        $timestamp = strtotime( $this->startdate);
        $date = $this->getSessionSubscriptionLimit();
        setlocale(LC_TIME, "fr_FR");
        //return strftime("%A %d %B %G", strtotime($date))." à 23h59";
        return utf8_encode(strftime("%d %B %G", strtotime($date)));
    } 

    function canSubscribe()
    {
        $canSubscribe = true;
        
        $subscriptionLimit = strtotime($this->getSessionSubscriptionLimit());
        $subscriptionLimit = wp_date('Ymd', $subscriptionLimit);
        $today = date("Ymd");
        if( (int)$subscriptionLimit < (int)$today )
        $canSubscribe=false;
       if(current_user_can('administrator'))
        $canSubscribe=true;
        return $canSubscribe;
    }

    //
    //
    // Inscription d'un user
    //
    //
    function addCustomer($user_ID)
    {
        $tab = $this->getCustomers();
        if ( !in_array($user_ID, $tab) && ($this->getSessionCountdown() > 0))
        {
            add_post_meta($this->id, 'session_customers', $user_ID, false);
            $this->setCustomerStatus($user_ID, 1);
            $this->setCustomerDateCreated($user_ID);
            $this->setDPC($user_ID, 0);
            // $this->setRegistrationForm($user_ID, 0);
            $this->setCustomer_eval_1_status($user_ID, 0);
            $this->setCustomer_eval_2_status($user_ID, 0);
            $this->setCustomer_satisfaction_status($user_ID, 0);
            $this->setCustomerAttendance($user_ID, 0);
            return true;
        }
        else
        {
            return false;
        }
    }
    // Suppression d'un user
    function deleteCustomer($user_ID)
    {
        delete_post_meta($this->id, 'session_customers', $user_ID);
        $this->deleteCustomerStatus($user_ID);
        $this->deleteCustomerDateCreated($user_ID);
        $this->deleteDPC($user_ID);
        $this->deleteRegistrationForm($user_ID);
        $this->deleteCustomer_eval_1_status($user_ID);
        $this->deleteCustomer_eval_1_startdate($user_ID);
        $this->deleteCustomer_eval_1_enddate($user_ID);
        $this->deleteCustomer_eval_2_status($user_ID);
        $this->deleteCustomer_eval_2_startdate($user_ID);
        $this->deleteCustomer_eval_2_enddate($user_ID);
        $this->deleteCustomer_satisfaction_status($user_ID);
        return true;
    }
    // Retourne un tableau avec tous les ID des inscrits
    function getCustomers()
    {
        $tab = get_post_meta($this->id,'session_customers',  false);
        return $tab;
    }
    // Retourne le nombre d'inscrits
    function getCustomersCount()
    {
        $tab = get_post_meta($this->id, 'session_customers',  false);
        return count($tab);
    }

    // Gestion du statut
    function setCustomerStatus($user_ID, $status)
    {
        update_post_meta($this->id, 'session_customer_'.$user_ID.'_status', $status);
        return true;
    }
    function getCustomerStatus($user_ID)
    {
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_status',  true);
        return $ph;
    }
    function getCustomerStatusNiceName($user_ID)
    {
       $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_status',  true);
        switch ($ph) {
            case 0:
            $ph = "Inscription invalide";
            break;
            case 1:
            $ph = "Inscription en attente";
            break;
            case 2:
            $ph = "Inscription validée";
            break;
        }
        return $ph;
    }
    function deleteCustomerStatus($user_ID)
    {
        delete_post_meta($this->id, 'session_customer_'.$user_ID.'_status');
    }

    // Présence à la session 
    function setCustomerAttendance($user_ID, $status)
    {
        update_post_meta($this->id, 'session_customer_'.$user_ID.'_attendance', $status);
        return true;
    }

    function getCustomerAttendance($user_ID){
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_attendance',  true);
        return $ph;
    }

    // Date de création
    function setCustomerDateCreated($user_ID)
    {
        update_post_meta($this->id, 'session_customer_'.$user_ID.'_date_created', time());
        return true;
    }
    function getCustomerDateCreated($user_ID)
    {
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_date_created',  true);
        return $ph;
    }
    function deleteCustomerDateCreated($user_ID)
    {
        delete_post_meta($this->id, 'session_customer_'.$user_ID.'_date_created');
        return true;
    }

    // Inscription sur mondpc.fr
    function setDPC($user_ID, $value)
    {
        update_post_meta($this->id, 'session_customer_'.$user_ID.'_dpc', $value);
        return true;
    }
    function getDPC($user_ID)
    {
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_dpc',  true);
        return $ph;
    }
    function deleteDPC($user_ID)
    {
        delete_post_meta($this->id, 'session_customer_'.$user_ID.'_dpc');
        return true;
    }

    // Dossier d'inscription reçu
    function setRegistrationForm($user_ID, $value)
    {
        update_post_meta($this->id, 'session_customer_'.$user_ID.'_registration_form', $value);
        return true;
    }
    function getRegistrationForm($user_ID)
    {
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_registration_form',  true);
        return $ph;
    }
    function deleteRegistrationForm($user_ID)
    {
        delete_post_meta($this->id, 'session_customer_'.$user_ID.'_registration_form');
        return true;
    }


    // Retourne les différents experts
    function getExpertsList()
    {
        $program = $this->program;
        $nodoublons=array();
        $experts = array();
        $i=0;
        foreach($program as $program_item)
        {
            if(is_array($program_item['session_program_expert'])){
                foreach( $program_item['session_program_expert'] as $session_program_expert )
                {

                    $expert = $session_program_expert['session_program_expert_member'];

                    if (!in_array($expert->ID, $nodoublons)) {
                        $nodoublons[$i]= $expert->ID;
                        $experts[$i]['ID'] = $expert->ID;
                        $experts[$i]['role'] = $session_program_expert['session_program_expert_role'];
                        $i++;
                    }

                }
            }
        }
        return $experts;
    }

    function getSessionEvalTotalToDo(){
        $cpt=0;
        if($this->evaluation_type == "app"){
            $cpt=2;
        }
        if($this->evaluation_type == "epp"){
            $cpt= ($this->epp_number * 2) ; 
        }
        if($this->evaluation_type == "app+epp"){
            $cpt= ($this->epp_number * 2) + 2 ; 
        }
        return $cpt;
    }



    function getSessionEvalTotalDone($userId){
        $cpt=0;

        if($this->evaluation_type == "app"){
            $app = new Quiz($this->app_form['id']);
            $cpt = $app->countUserFormEntries($userId, 1, $this->id);
            $cpt += $app->countUserFormEntries($userId, 2, $this->id);                 
        }

        if($this->evaluation_type == "epp"){
            $epp = new Quiz($this->epp_form['id']);
            $cpt = $epp->countUserFormEntries($userId, 1, $this->id);
            $cpt += $epp->countUserFormEntries($userId, 2, $this->id);                 
        }

        if($this->evaluation_type == "app+epp"){
            $app = new Quiz($this->app_form['id']);
            $epp = new Quiz($this->epp_form['id']);     
            $cpt = $app->countUserFormEntries($userId, 1, $this->id);
            $cpt += $app->countUserFormEntries($userId, 2, $this->id);
            $cpt += $epp->countUserFormEntries($userId, 1, $this->id);
            $cpt += $epp->countUserFormEntries($userId, 2, $this->id);
        }
        return $cpt;
    }

    function getSessionEvalDebut($user_id,$eval){
        $login="first";
        $app = new Quiz($this->app_form['id']);
        if($this->evaluation_type == "app"){
            if ($app->countUserFormEntries($user_id, $eval, $this->id) >= 1)
            {
                $login = strtotime($app->getUserFormEntryDate($user_id, $eval, $this->id));
                $duration=$app->getUserFormDuration($user_id, $eval, $this->id);
                $login = $login - $duration;
                $login = date("Y-m-d H:i:s", $login);
            }
            else{
                $login = "..."; 
            } 

        }
        if($this->evaluation_type == "epp"){
            $epp = new Quiz($this->epp_form['id']);
            if ($epp->countUserFormEntries($user_id, $eval, $this->id) >= 1)
            {
                $login = strtotime($epp->getUserFormEntryDate($user_id, $eval, $this->id));
                $duration=$epp->getUserFormDuration($user_id, $eval, $this->id);
                $login = $login - $duration;
                $login = date("Y-m-d H:i:s", $login); 
            }  
            else{
                $login = "..."; 
            } 
        }
        if($this->evaluation_type == "app+epp"){
            $app = new Quiz($this->app_form['id']);
            if ($app->countUserFormEntries($user_id, $eval, $this->id) >= 1)
            {
                $login = strtotime($app->getUserFormEntryDate($user_id, $eval, $this->id));
                $duration=$app->getUserFormDuration($user_id, $eval, $this->id);
                $login = $login - $duration;
                $login = date("Y-m-d H:i:s", $login);
            }
            else{
                $login = "..."; 
            } 
        }
        return $login;
    }

    function getSessionEvalEnd($user_id,$eval){
        $login=0;
        if($this->evaluation_type == "app"){
            $app = new Quiz($this->app_form['id']);
            // si eval app 2 finie 
            if ($app->countUserFormEntries($user_id, $eval, $this->id) >= 1)
            {
                $login = $app->getUserFormEntryDate($user_id, $eval, $this->id);  
            }
            // si eval app 2 pas finie
            elseif ($app->countUserFormEntries($user_id, $eval, $this->id) == 0)
            {
                $login = $app->getUserFormEntryDate($user_id, $eval, $this->id);  
            }
        }
        if($this->evaluation_type == "epp"){
            $epp = new Quiz($this->epp_form['id']); 
            // si eval epp 2 commencée 
            if ($epp->countUserFormEntries($user_id, $eval, $this->id) >= 1)
            {
                $login = $epp->getUserFormEntryDate($user_id, $eval, $this->id);  
            }
            // si eval epp 2 pas finie
            elseif ($epp->countUserFormEntries($user_id, $eval, $this->id) == 0) 
            {
                $login = $epp->getUserFormEntryDate($user_id, $eval, $this->id);  
            } 
            else{
                $login = "..."; 
            }  
        }
        if($this->evaluation_type == "app+epp"){
            $app = new Quiz($this->app_form['id']);
            $epp = new Quiz($this->epp_form['id']);  
            // si eval app finie et eval epp commencée
            if (($app->countUserFormEntries($user_id, $eval, $this->id) >= 1)
            && ($epp->countUserFormEntries($user_id, $eval, $this->id) >= 1))
            {
                $login = $epp->getUserFormEntryDate($user_id, $eval, $this->id);  
            }
            // si eval app finie et eval epp pas commencée
            elseif (($app->countUserFormEntries($user_id, $eval, $this->id) >= 1)
            && ($epp->countUserFormEntries($user_id, $eval, $this->id) == 0))
            {
                $login = $app->getUserFormEntryDate($user_id, $eval, $this->id); 
            }
            else{
                $login = "..."; 
            }
        }
        return $login;
    }
    function getSessionEvalPercentageDone($userId){
    $total = (int) $this->getSessionEvalTotalToDo();
        if ($total <= 0) {
            return 0; // ou null / ou 0% par défaut
        }
        $done = (int) $this->getSessionEvalTotalDone($userId);
        return (int) round(($done * 100) / $total);
    }

function getUserProgressSteps($user_id){

    $eval_type = $this->normalizeEvalType();

    $eval_type = strtolower(trim((string) $this->evaluation_type));
    $eval_type = str_replace(' ', '', $eval_type); // "app + epp" => "app+epp"

    $app_form_id = !empty($this->app_form['id']) ? (int) $this->app_form['id'] : 0;
    $epp_form_id = !empty($this->epp_form['id']) ? (int) $this->epp_form['id'] : 0;
    $app = new Quiz($app_form_id); 
    $epp = new Quiz($epp_form_id);
    $epp_number  = (int) $this->epp_number;

    $html = '<ul class="progress-steps">';
    //$html.= var_dump($this);
    // Inscription
    $html .= ($this->getCustomerStatus($user_id) == 2)
        ? '<li class="step checked"><span>Validez votre inscription</span></li>'
        : '<li class="step unchecked"><span>Validez votre inscription</span></li>';

    // PRE - APP
    if ($eval_type === 'app' || $eval_type === 'app+epp') {
        if ($app_form_id > 0) {
            $app = new Quiz($app_form_id);
            $done = ($app->countUserFormEntries($user_id, 1, $this->id) >= 1) || ($this->getCustomer_eval_1_status($user_id) == 2);
            $html .= $done
                ? '<li class="step checked"><span>Analyse de pratique professionnelles</span></li>'
                : '<li class="step unchecked"><span>Analyse de pratique professionnelles</span></li>';
        } else {
            $html .= '<li class="step unchecked"><span>APP (formulaire manquant)</span></li>';
        }
    }

    // PRE - EPP
    if ($eval_type === 'epp' || $eval_type === 'app+epp') {
        if ($epp_form_id > 0 && $epp_number > 0) {
            $epp = new Quiz($epp_form_id);
            $done = ($epp->countUserFormEntries($user_id, 1, $this->id) >= $epp_number) || ($this->getCustomer_eval_1_status($user_id) == 2);
            $html .= $done
                ? '<li class="step checked"><span>Évaluation de pratique professionnelles</span></li>'
                : '<li class="step unchecked"><span>Évaluation de pratique professionnelles</span></li>';
        } else {
            // optionnel : tu peux afficher un step "EPP non concerné" si tu veux
            // $html .= '<li class="step checked"><span>EPP non concerné</span></li>';
        }
    }

    // Présence
    $html .= ($this->getCustomerAttendance($user_id) == 2)
        ? '<li class="step checked"><span>Présence validée à la session</span></li>'
        : '<li class="step unchecked"><span>Présence validée à la session</span></li>';

    // POST - APP (même logique)
    if ($eval_type === 'app' || $eval_type === 'app+epp') {
        if ($app_form_id > 0) {
            $app = $app ?? new Quiz($app_form_id);
            $done = ($app->countUserFormEntries($user_id, 2, $this->id) >= 1) || ($this->getCustomer_eval_2_status($user_id) == 2);
            $html .= $done
                ? '<li class="step checked"><span>Analyse de pratique professionnelles</span></li>'
                : '<li class="step unchecked"><span>Analyse de pratique professionnelles</span></li>';
        }
    }

    // POST - EPP
    if ($eval_type === 'epp' || $eval_type === 'app+epp') {
        if ($epp_form_id > 0 && $epp_number > 0) {
            $epp = $epp ?? new Quiz($epp_form_id);
            $done = ($epp->countUserFormEntries($user_id, 2, $this->id) >= $epp_number) || ($this->getCustomer_eval_2_status($user_id) == 2);
            $html .= $done
                ? '<li class="step checked"><span>Évaluation de pratique professionnelles</span></li>'
                : '<li class="step unchecked"><span>Évaluation de pratique professionnelles</span></li>';
        }
    }

    // Avis
    $html .= ($this->getCustomer_satisfaction_status($user_id) == 2)
        ? '<li class="step checked"><span>Votre avis sur la formation</span></li>'
        : '<li class="step unchecked"><span>Votre avis sur la formation</span></li>';

    $html .= '</ul>';

    $html .= $this->getSessionEvalNextStepCta($user_id);

    return $html;
}
private function normalizeEvalType(): string {
    $t = $this->evaluation_type;

    if (is_array($t)) {
        $t = $t['value'] ?? ($t['label'] ?? '');
    }

    $t = strtolower(trim((string) $t));
    $t = str_replace(' ', '', $t); // "app + epp" -> "app+epp"
    return $t;
}

    // AJOUTER LES FILTRES AVEC LES DATES D'OUVERTURE ET FERMETURE PLEASE
    function getSessionEvalNextStepCta($user_id){

        $url='./?post_id='.$this->id.'&action=view';
        $cta_text = 'Test';
        $html = '<div>';


        $cta_text = 'Faire mon évaluation pré-formation';

        $app = new Quiz($this->app_form['id']);

        // si la Session est en cours
        if($this->getCustomerStatus($user_id) != 2){
            $html.= '<p class="toaster toaster-info">Inscription en cours de validation</p>';
            $cta_text = 'En savoir plus';
           // $url='./?post_id='.$this->id.'&action=view'>;
            //$html.= '<a href="'.$url.'" class="btn">'.$cta_text.'</a>';
        }

        // si la session est cloturée (dates dépassées)
        elseif ( $this->eval_1_enddate < date('Ymd', strtotime('now')) && $this->eval_2_enddate < date('Ymd', strtotime('now')))
        {
            $html.= '<p class="toaster toaster-warning">Session clôturée </p>';
            
           // $html.= $this->eval_1_enddate." / ".$this->eval_2_enddate.' / '.date('Ymd', strtotime('now'));
        }

        ////
        //
        //
        // EVALUATION APP SEULE
        //
        //
        ////

        elseif($this->evaluation_type == "app"){

            if(
                // si l'eval APP eval_1 n'a pas été validée 
                ($app->countUserFormEntries($user_id, 1, $this->id) < 1)  || ($this->getCustomer_eval_1_status($user_id) != 2)
              //  $this->getCustomer_eval_1_status($user_id) != 2
               )
            {
                // vérification des dates d'ouverture et fermeture
                if (isDateRangeValid($this->eval_1_startdate, $this->eval_1_enddate))
                {
                    $cta_text = 'Démarrer mon évaluation APP pré-formation';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.get_current_user_id().'&session_id='.$this->id.'&session_eval=1&action=eval_show&eval_type=app&qcm_id='.$this->app_form['id'];
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                }
                else{
                    $html .= $this->getEvalNiceRange(1);   
                }
            }

            elseif( 
                // si l'eval APP pré-formation eval_1 a été validée 
                ( $app->countUserFormEntries(get_current_user_id(), 1, $this->id) >= 1  || $this->getCustomer_eval_1_status($user_id) == 2 ) &&
                // et que l'eval APP eval_2 n'a pas été validée
                ( $app->countUserFormEntries(get_current_user_id(), 2, $this->id) < 1) || ($this->getCustomer_eval_2_status($user_id) < 2 )
            )
            {
                // vérification des dates d'ouverture et fermeture
                if (isDateRangeValid($this->eval_2_startdate, $this->eval_2_enddate))
                {
                    $cta_text = 'Faire mon évaluation APP post-formation';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.get_current_user_id().'&session_id='.$this->id.'&session_eval=2&action=eval_show&eval_type=app&qcm_id='.$this->app_form['id'];
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                }
                else{
                    $html .= $this->getEvalNiceRange(2);   
                }
            }  
            
            elseif( 
                // si l'eval APP pré-formation eval_1 a été validée 
                ($app->countUserFormEntries(get_current_user_id(), 1, $this->id) >= 1  || $this->getCustomer_eval_1_status($user_id) == 2 ) &&
                // et que l'eval APP eval_2 a  été validée
                ( $app->countUserFormEntries(get_current_user_id(), 2, $this->id) >= 1  || $this->getCustomer_eval_2_status($user_id) == 2 )
            )
            {
                if ( $this->getCustomer_satisfaction_status(get_current_user_id()) == 0)
                {
                    $cta_text = 'Je laisse mon avis';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.get_current_user_id().'&session_id='.$this->id.'&satisfaction_eval=true';
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                }
                else
                {
                    $html.= '<p class="toaster success">Toutes les évaluations ont été réalisées</p>';    
                }
            }     
        }
        ////
        //
        //
        // EVALUATION EPP SEULE
        //
        //
        ////
        elseif($this->evaluation_type == "epp"){
            $epp = new Quiz($this->epp_form['id']);   
            if( 
                // si toutes les éval EPP eval_1 n'ont pas été réalisées
                ( $epp->countUserFormEntries($user_id, 1, $this->id) < $this->epp_number || $this->getCustomer_eval_1_status($user_id) != 2 ) 
               //$this->getCustomer_eval_1_status($user_id) != 2
            )
            {
                // vérification des dates d'ouverture et fermeture
                if (isDateRangeValid($this->eval_1_startdate, $this->eval_1_enddate))
                {
                    $cta_text = 'Faire mon évaluation EPP pré-formation';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.get_current_user_id().'&session_id='.$this->id.'&session_eval=1&action=eval_show&eval_type=epp&qcm_id='.$this->epp_form['id'];
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                    $html.= '<p class="toaster info">Nombre de cas pratiques réalisés : '.$epp->countUserFormEntries($user_id, 1, $this->id).' / '.$this->epp_number.'</p>';
                }
                else{
                    $html .= $this->getEvalNiceRange(1);
                }
            }

            elseif( 
                // si toutes les éval EPP eval_1 ont été réalisées
                ($epp->countUserFormEntries($user_id, 1, $this->id) >= $this->epp_number || $this->getCustomer_eval_1_status($user_id) >= 2 ) &&
                // et que toutes les éval EPP eval_2 n'ont été réalisées
                ( $epp->countUserFormEntries($user_id, 2, $this->id) < $this->epp_number && $this->getCustomer_eval_2_status($user_id) != 2 )
            )
            {
                // vérification des dates d'ouverture et fermeture
                if (isDateRangeValid($this->eval_2_startdate, $this->eval_2_enddate))
                {
                    $cta_text = 'Faire mon évaluation EPP post-formation';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.get_current_user_id().'&session_id='.$this->id.'&session_eval=2&action=eval_show&eval_type=epp&qcm_id='.$this->epp_form['id'];
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                    $html.= '<p class="toaster info">Nombre de cas pratiques réalisés :'.$epp->countUserFormEntries($user_id, 2, $this->id).' / '.$this->epp_number.'</p>';
                }
                else{
                    $html .= $this->getEvalNiceRange(2);
                }
            }    
            elseif( 
                // si toutes les éval EPP eval_1 ont été réalisées
                ($epp->countUserFormEntries($user_id, 1, $this->id) >= $this->epp_number || $this->getCustomer_eval_1_status($user_id) == 2 ) &&
                // et que toutes les éval EPP eval_2 ont été réalisées
                ( $epp->countUserFormEntries($user_id, 2, $this->id) >= $this->epp_number || $this->getCustomer_eval_2_status($user_id) == 2 ) 
            )
            {
                if ( $this->getCustomer_satisfaction_status($user_id) == 0)
                {
                    $cta_text = 'Je laisse mon avis';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.$user_id.'&session_id='.$this->id.'&satisfaction_eval=true';
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                }
                else
                {
                    $html.= '<p class="toaster success">Toutes les évaluations ont été réalisées</p>';    
                }  
            }     
        }

        ////
        //
        //
        // EVALUATION APP + EPP
        //
        //
        ////
        elseif($this->evaluation_type == "app+epp"){
            $epp = new Quiz($this->epp_form['id']);   

            // Si le statut des 2 eval est validé
            if($this->getCustomer_eval_1_status($user_id) == 2 && $this->getCustomer_eval_2_status($user_id) == 2 ){
                if ( $this->getCustomer_satisfaction_status($user_id) == 0)
                {
                    $cta_text = 'Je laisse mon avis';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.$user_id.'&session_id='.$this->id.'&satisfaction_eval=true';
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                }
                else
                {
                    $html.= '<p class="toaster success">Toutes les évaluations ont été réalisées</p>';    
                }  
            }

            elseif
            (
                // si l'eval APP eval_1 n'a pas été validée 
                ( $app->countUserFormEntries($user_id, 1, $this->id) < 1)  && ($this->getCustomer_eval_1_status($user_id) != 2 )
            )
            {
                // vérification des dates d'ouverture et fermeture
                if (isDateRangeValid($this->eval_1_startdate, $this->eval_1_enddate))
                {
                    $cta_text = 'Démarrer mon évaluation APP pré-formation';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.get_current_user_id().'&session_id='.$this->id.'&session_eval=1&action=eval_show&eval_type=app&qcm_id='.$this->app_form['id'];
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                }
                else{
                    $html .= $this->getEvalNiceRange(1);
                }
            }

            
            elseif( 
                (
                    // si l'eval APP pré-formation eval_1 a été validée et que toutes les éval EPP eval_1 n'ont pas été réalisées
                     $app->countUserFormEntries($user_id, 1, $this->id) >= 1  && $epp->countUserFormEntries($user_id, 1, $this->id) < $this->epp_number              
                ) 
                    // et que le statut de l'eval 1 n'est pas validé
                    && $this->getCustomer_eval_1_status($user_id) != 2
                )
            {
                // vérification des dates d'ouverture et fermeture
                if (isDateRangeValid($this->eval_1_startdate, $this->eval_1_enddate))
                {
                    $cta_text = 'Faire mon évaluation EPP pré-formation';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.get_current_user_id().'&session_id='.$this->id.'&session_eval=1&action=eval_show&eval_type=epp&qcm_id='.$this->epp_form['id'];
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                    $html.= '<p class="toaster info">Nombre de cas pratiques réalisés : '.$epp->countUserFormEntries($user_id, 1, $this->id).' / '.$this->epp_number.'</p>';
                }
                else{
                    $html .= $this->getEvalNiceRange(1);
                }
            }

            elseif( 
                (
                    (
                        // si l'eval APP pré-formation eval_1 a été validée et que toutes les éval EPP eval_1 ont été réalisées
                        $app->countUserFormEntries($user_id, 1, $this->id) >= 1) && ($epp->countUserFormEntries($user_id, 1, $this->id) >= $this->epp_number 
                    )
                        // ou que le statut eval 1 est validé
                        || $this->getCustomer_eval_1_status($user_id) == 2
                )
                &&
                (
                    // et que l'eval APP eval_2 n'a pas été validée
                    $app->countUserFormEntries($user_id, 2, $this->id) < 1 && $this->getCustomer_eval_2_status($user_id) != 2
                )
            )
            {
                // vérification des dates d'ouverture et fermeture
                if( isDateRangeValid($this->eval_2_startdate, $this->eval_2_enddate) )
                {
                    $cta_text = 'Faire mon évaluation APP post-formation';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.get_current_user_id().'&session_id='.$this->id.'&session_eval=2&action=eval_show&eval_type=app&qcm_id='.$this->app_form['id'];
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                }
                else{
                    $html .= $this->getEvalNiceRange(2);
                }
            }

            elseif( 
                (
                    (
                        // si l'eval APP pré-formation eval_1 a été validée et que toutes les éval EPP eval_1 ont été réalisées
                        $app->countUserFormEntries($user_id, 1, $this->id) >= 1 && $epp->countUserFormEntries($user_id, 1, $this->id) >= $this->epp_number
                    )
                        // ou que le statut eval 1 est validé
                        || $this->getCustomer_eval_1_status($user_id) == 2
                )
                &&
                (
                    // et que l'eval APP eval_2 a été validée et que toutes les éval EPP eval_2 n'ont été réalisées
                    ( $app->countUserFormEntries($user_id, 2, $this->id) >= 1) && ( $epp->countUserFormEntries($user_id, 2, $this->id) < $this->epp_number ) && $this->getCustomer_eval_2_status($user_id) != 2

                )

            )
            {
                // vérification des dates d'ouverture et fermeture
                if (isDateRangeValid($this->eval_2_startdate, $this->eval_2_enddate))
                {
                    $cta_text = 'Faire mon évaluation EPP post-formation';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.get_current_user_id().'&session_id='.$this->id.'&session_eval=2&action=eval_show&eval_type=epp&qcm_id='.$this->epp_form['id'];
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                    $html.= '<p class="toaster info">Nombre de cas pratiques réalisés :'.$epp->countUserFormEntries($user_id, 2, $this->id).' / '.$this->epp_number.'</p>';
                }
                else{
                    $html .= $this->getEvalNiceRange(2);
                }
            }    
            elseif( 
                // si l'eval APP pré-formation eval_1 a été validée 
                ($app->countUserFormEntries($user_id, 1, $this->id) >= 1) &&
                // et que toutes les éval EPP eval_1 ont été réalisées
                ($epp->countUserFormEntries($user_id, 1, $this->id) >= $this->epp_number ) &&
                // et que l'eval APP eval_2 a été validée
                ($app->countUserFormEntries($user_id, 2, $this->id) >= 1) && 
                // et que toutes les éval EPP eval_2 ont été réalisées
                ( $epp->countUserFormEntries($user_id, 2, $this->id) >= $this->epp_number )
            )
            {
                if ( $this->getCustomer_satisfaction_status($user_id) == 0)
                {
                    $cta_text = 'Je laisse mon avis';
                    $url = '/mon-compte/mes-sessions-dpc/?customer_id='.$user_id.'&session_id='.$this->id.'&satisfaction_eval=true';
                    $html.= '<a href="'.$url.'" class="btn btn-steps">'.$cta_text.'</a>';
                }
                else
                {
                    $html.= '<p class="toaster success">Toutes les évaluations ont été réalisées</p>';    
                }  
            }     
        }



        $html .= '</div>';
        return $html;
    }

    function getEvalNiceRange($eval){
        if($eval == 1)
        {
            $startdate = strtotime($this->eval_1_startdate);
            $enddate = strtotime($this->eval_1_enddate);


            if ($startdate > strtotime(datetime: "now"))
            $text = "<p class='toaster warning'>Votre évaluation ouvrira le ".getNiceDate($this->eval_1_startdate)."</div>";
            if ($enddate < strtotime("now"))
            $text = "Évaluation pré-formation cloturée depuis le ".getNiceDate($this->eval_1_enddate)."</div>";
        }
        if($eval == 2)
        {
            $startdate = strtotime($this->eval_2_startdate);
            $enddate = strtotime($this->eval_2_enddate);
            
            if ($startdate > strtotime("now"))
            $text = "<p class='toaster warning'>Votre évaluation ouvrira le ".getNiceDate($this->eval_2_startdate)."</div>";
            if ($enddate < strtotime("now"))
            $text = "<p class='toaster warning'>Évaluation post-formation cloturée depuis le ".getNiceDate($this->eval_2_enddate)."</div>";
        }
        return $text;
    }

    //
    //
    //
    // Eval préformation
    function setCustomer_eval_1_status($user_ID, $value)
    {
        update_post_meta($this->id, 'session_customer_'.$user_ID.'_eval_1', $value);
        return true;
    }
    function getCustomer_eval_1_status($user_ID)
    {
        if(empty(get_post_meta($this->id,'session_customer_'.$user_ID.'_eval_1',  true) ) ){
            $ph = 0;
        }
        else
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_eval_1',  true);

        if($ph == 2){
            return 2;
        }
        elseif($this->evaluation_type == "app"){
            $app = new Quiz($this->app_form['id']);
            // si l'eval APP pré-formation eval_1 a été validée 
            if( $app->countUserFormEntries($user_ID, 1, $this->id) == 1 )
            {
                return 2;
            }
        }
        elseif($this->evaluation_type == "epp"){
            $epp = new Quiz($this->epp_form['id']);
            // si l'eval EPP pré-formation eval_1 a été commencée 
            if( ($epp->countUserFormEntries($user_ID, 1, $this->id) > 0 ) && ($epp->countUserFormEntries($user_ID, 1, $this->id) < $this->epp_number) )
            {
                return 1;
            }
            // si l'eval EPP eval_1 a été validée entièrement
            if( $epp->countUserFormEntries($user_ID, 1, $this->id) == $this->epp_number )
            {
                return 2;
            }
        }
        elseif($this->evaluation_type == "app+epp"){
            $app = new Quiz($this->app_form['id']);
            $epp = new Quiz($this->epp_form['id']);
            // si l'eval APP pré-formation eval_1 a été validée 
            if( ($app->countUserFormEntries($user_ID, 1, $this->id) == 1) )
            {
                // si l'eval EPP pré-formation eval_1 a été commencée 
                if( $epp->countUserFormEntries($user_ID, 1, $this->id) < $this->epp_number )
                {
                    return 1;
                }
                // si l'eval EPP eval_1 a été validée entièrement
                elseif( $epp->countUserFormEntries($user_ID, 1, $this->id) >= $this->epp_number )
                {
                    return 2;
                }
            }
        }
        else{
            return $ph;
        }
    }
    function deleteCustomer_eval_1_status($user_ID)
    {
        $ph = delete_post_meta($this->id,'session_customer_'.$user_ID.'_eval_1');
        return $ph;
    }
    //
    // QCM 1 STARTDATE
    function setCustomer_eval_1_startdate($user_ID, $value)
    {
        add_post_meta($this->id, 'session_customer_'.$user_ID.'_eval_1_startdate', $value, true);
        return true;
    }
    function getCustomer_eval_1_startdate($user_ID)
    {
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_eval_1_startdate',  true);
        return $ph;
    }
    function deleteCustomer_eval_1_startdate($user_ID)
    {
        $ph = delete_post_meta($this->id,'session_customer_'.$user_ID.'_eval_1_startdate');
        return $ph;
    }
    //
    // QCM 1 ENDDATE
    function setCustomer_eval_1_enddate($user_ID, $value)
    {
        add_post_meta($this->id, 'session_customer_'.$user_ID.'_eval_1_enddate', $value, true);
        return true;
    }
    function getCustomer_eval_1_enddate($user_ID)
    {
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_eval_1_enddate',  true);
        return $ph;
    }
    function deleteCustomer_eval_1_enddate($user_ID)
    {
        $ph = delete_post_meta($this->id,'session_customer_'.$user_ID.'_eval_1_enddate');
        return $ph;
    }

    function getCustomer_eval_1_duration($user_ID)
    {

        if( ($this->getCustomer_eval_1_status($user_ID) == 2) && $this->getCustomer_eval_1_enddate($user_ID) )
        {
            $a=($this->getCustomer_eval_1_enddate($user_ID) - $this->getCustomer_eval_1_startdate($user_ID));
            $ph=$this->getCustomer_eval_1_enddate($user_ID)." / ".$this->getCustomer_eval_1_startdate($user_ID)." / ".$a;
            $ph = gmdate( "H:i:s",  $a ) ;
        }
        
        elseif($this->evaluation_type == "app" || $this->evaluation_type == "epp" || $this->evaluation_type == "app+epp")
        {
            $cpt=0;
            if($this->evaluation_type == "app"){
                $app = new Quiz($this->app_form['id']);
                $cpt = $app->getUserFormDuration($user_ID, 1, $this->id);   
            }
            if($this->evaluation_type == "epp"){
                $epp = new Quiz($this->epp_form['id']);   
                $cpt = $epp->getUserFormDuration($user_ID, 1, $this->id);   
            }
            if($this->evaluation_type == "app+epp"){
                $app = new Quiz($this->app_form['id']);
                $epp = new Quiz($this->epp_form['id']);  

                $cpt = $app->getUserFormDuration($user_ID, 1, $this->id);
                $cpt += $epp->getUserFormDuration($user_ID, 1, $this->id);

            }    
            //$ph=$cpt;
            $ph = $cpt;      
        }
        else
        $ph = "...";
        return $ph;
    }
    //
    //
    //
    // Eval post formation
    function setCustomer_eval_2_status($user_ID, $value)
    {
        update_post_meta($this->id, 'session_customer_'.$user_ID.'_eval_2', $value);
        return true;
    }
    function getCustomer_eval_2_status($user_ID)
    {
        if(empty(get_post_meta($this->id,'session_customer_'.$user_ID.'_eval_2',  true) ) ){
            $ph = 0;
        }
        else
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_eval_2',  true);
        

        if($ph == 2){
            return 2;
        }
        elseif($this->evaluation_type == "app"){
            $app = new Quiz($this->app_form['id']);
            // si l'eval APP pré-formation eval_1 a été validée 
            if( $app->countUserFormEntries($user_ID, 2, $this->id) == 1 )
            {
                return 2;
            }
        }
        elseif($this->evaluation_type == "epp"){
            $epp = new Quiz($this->epp_form['id']);
            // si l'eval EPP pré-formation eval_1 a été commencée 
            if( $epp->countUserFormEntries($user_ID, 2, $this->id) < $this->epp_number)
            {
                return 1;
            }
            // si l'eval EPP pré-formation eval_1 a été validée 
            elseif( $epp->countUserFormEntries($user_ID, 2, $this->id) >= $this->epp_number )
            {
                return 2;
            }
        }
        elseif($this->evaluation_type == "app+epp"){
            $app = new Quiz($this->app_form['id']);
            $epp = new Quiz($this->epp_form['id']);
            // si l'eval APP pré-formation eval_2 a été validée 
            
            if( ($app->countUserFormEntries($user_ID, 2, $this->id) == 1) )
            {
                // si l'eval EPP pré-formation eval_2 a été commencée & que l'eval EPP est inférieure au nombre demandé 
                if( ($epp->countUserFormEntries($user_ID, 2, $this->id) > 0 ) && ($epp->countUserFormEntries($user_ID, 2, $this->id) < $this->epp_number) )
                {
                    return 1;
                }
                // si l'eval EPP eval_2 a été validée entièrement
                if( $epp->countUserFormEntries($user_ID, 2, $this->id) == $this->epp_number )
                {
                    return 2;
                }
            }
        }
        else{
            return $ph;
        }
    }
    function deleteCustomer_eval_2_status($user_ID)
    {
        $ph = delete_post_meta($this->id,'session_customer_'.$user_ID.'_eval_2');
        return $ph;
    }


    //
    // QCM 2 STARTDATE
    function setCustomer_eval_2_startdate($user_ID, $value)
    {
        add_post_meta($this->id, 'session_customer_'.$user_ID.'_eval_2_startdate', $value, true);
        return true;
    }
    function getCustomer_eval_2_startdate($user_ID)
    {
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_eval_2_startdate',  true);
        return $ph;
    }
    function deleteCustomer_eval_2_startdate($user_ID)
    {
        $ph = delete_post_meta($this->id,'session_customer_'.$user_ID.'_eval_2_startdate');
        return $ph;
    }
    //
    // QCM 2 ENDDATE
    function setCustomer_eval_2_enddate($user_ID, $value)
    {
        add_post_meta($this->id, 'session_customer_'.$user_ID.'_eval_2_enddate', $value, true);
        return true;
    }
    function getCustomer_eval_2_enddate($user_ID)
    {
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_eval_2_enddate',  true);
        return $ph;
    }
    function deleteCustomer_eval_2_enddate($user_ID)
    {
        $ph = delete_post_meta($this->id,'session_customer_'.$user_ID.'_eval_2_enddate');
        return $ph;
    }
    function getCustomer_eval_2_duration($user_ID)
    {

        // pour les anciennes données
        if( ($this->getCustomer_eval_2_status($user_ID) == 2) && $this->getCustomer_eval_2_enddate($user_ID) )
        $ph = gmdate( "H:i:s", $this->getCustomer_eval_2_enddate($user_ID) - $this->getCustomer_eval_2_startdate($user_ID) );

        // nouveau format
        elseif($this->evaluation_type == "app" || $this->evaluation_type == "epp" || $this->evaluation_type == "app+epp")
        {
            $cpt=0;
            if($this->evaluation_type == "app"){
                $app = new Quiz($this->app_form['id']);
                $cpt = $app->getUserFormDuration($user_ID, 2, $this->id);   
            }
            if($this->evaluation_type == "epp"){
                $epp = new Quiz($this->epp_form['id']);   
                $cpt = $epp->getUserFormDuration($user_ID, 2, $this->id);   
            }
            if($this->evaluation_type == "app+epp"){
                $app = new Quiz($this->app_form['id']);
                $epp = new Quiz($this->epp_form['id']);  

                $cpt = $app->getUserFormDuration($user_ID, 2, $this->id);
                $cpt += $epp->getUserFormDuration($user_ID, 2, $this->id);

            }    
            //$ph=$cpt;
            $ph = $cpt;     
        }
        else
        $ph ="...";
        return $ph;
    }
    function getCustomer_eval_all_duration($user_ID)
    {
        /*
        // nouveau format
        if($this->evaluation_type == "app" || $this->evaluation_type == "epp" || $this->evaluation_type == "app+epp")
        {
            $cpt=(int)0;
            if($this->evaluation_type == "app"){
                $app = new Quiz($this->app_form['id']);
                $cpt = $app->getUserFormDuration($user_ID, 1, $this->id);   
                $cpt += $app->getUserFormDuration($user_ID, 2, $this->id);   
            }
            if($this->evaluation_type == "epp"){
                $epp = new Quiz($this->epp_form['id']);   
                $cpt = $epp->getUserFormDuration($user_ID, 1, $this->id);
                $cpt += $epp->getUserFormDuration($user_ID, 2, $this->id);   
            }
            if($this->evaluation_type == "app+epp"){
                $app = new Quiz($this->app_form['id']);
                $epp = new Quiz($this->epp_form['id']);


                $cpt = $app->getUserFormDuration($user_ID, 1, $this->id);
                $cpt += $epp->getUserFormDuration($user_ID, 1, $this->id);
                $cpt += $app->getUserFormDuration($user_ID, 2, $this->id);   
                $cpt += $app->getUserFormDuration($user_ID, 2, $this->id);      
              
            }
            //$ph=$cpt;
            $ph = gmdate("H:i:s", $cpt);      
        }
        */
        if($this->evaluation_type == "app" || $this->evaluation_type == "epp" || $this->evaluation_type == "app+epp"){
            $cpt = $this->getCustomer_eval_1_duration($user_ID);
            $cpt += $this->getCustomer_eval_2_duration($user_ID);
            return  $cpt;
        }
        else
        $ph ="...";
        return $ph;
    }

    //
    //
    //
    // Satisfaction
    function setCustomer_satisfaction_status($user_ID, $value)
    {
        update_post_meta($this->id, 'session_customer_'.$user_ID.'_satisfaction', $value);
        return true;
    }
    function getCustomer_satisfaction_status($user_ID)
    {
        $ph = get_post_meta($this->id,'session_customer_'.$user_ID.'_satisfaction',  true);
        return $ph;
    }
    function deleteCustomer_satisfaction_status($user_ID)
    {
        $ph = delete_post_meta($this->id,'session_customer_'.$user_ID.'_satisfaction');
        return $ph;
    }

    function getAlerts($user_ID)
    {
        $ph="";

    }



}
