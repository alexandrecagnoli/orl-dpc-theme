<?

function my_week_range($date,$offset)
{

    $nbsemaines=52;
    $frenchDays=array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');

    $ts = strtotime($date);
    $referenceDay = date('w', $ts); // On recupere le numero de jour de la semaine.

    $selectedDate = new DateTime($date);
    $date = new DateTime($date);

    $selectedDate->modify('+'.$offset.' week');
    $dayoffset = get_day_offset($referenceDay);
    
    $tss = strtotime($selectedDate);



    $selectedDate->modify('+'.$dayoffset.' day');

    $allWeekDays= new DatePeriod(
        $selectedDate,
        DateInterval::createFromDateString('+1 days'),
        6
    );
    $tab = iterator_to_array($allWeekDays);

    $lundi = $tab[0];
    $mardi = $tab[1];
    $mercredi = $tab[2];
    $jeudi = $tab[3];
    $vendredi = $tab[4];
    $samedi = $tab[5];
    $dimanche = $tab[6];

    $lundiN = get_date_infos($lundi,'W');


    return array(
    'currentdate'   =>  $date,
    'selectedDate'  =>  $selectedDate,
    'reference' => $referenceDay,
    'offset' => $dayoffset,
    'str2'  =>  $allWeekDays,
    'day1'  => $lundi,
    'day2'  => $mardi,
    'day3'  => $mercredi,
    'day4'  => $jeudi,
    'day5'  => $vendredi,
    'day6'  => $samedi,
    'day7'  => $dimanche,
);
    //return $allWeekDays;
}



function get_date_infos($date,$format)
{
        $ts = strtotime($date);
        $format = date($format, $date);
        return $format;
}

function get_day_offset($referenceDay)
{
    $dayoffset;
    if($referenceDay == 1)
    {
        $dayoffset=0;
    }
    else
    {
        if($referenceDay==0)
        $dayoffset="-6";
        else
        $dayoffset=-($referenceDay-1);
    }

    return $dayoffset;
}

function formatMonth($month)
{

    $tabMonths = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
    $month=$tabMonths[$month];
    return $month;
}

function fromatDay($day)
{
    $jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
    return $jour;
}

