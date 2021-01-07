<?php


// setting default TZ for DateTime proper operation
$defaultTz = ini_get('date.timezone');
if(!isset($defaultTz) || $defaultTz == '') {
    ini_set('date.timezone', 'Asia/Yerevan');
}


// phpinfo();
echo "<h1>Service Helper (SMS Helper) test page</h1>";
echo '<pre>';
var_dump($_SERVER['AUTH_TYPE']);
var_dump($_SERVER['REMOTE_USER']);



//https://servicehelper.mts.am/launch/<WDE_Transaction_ID>/<Contact_Name>/<Event_Channel>/<Call_StartDate>/<Login_Id>
//
//Where:
//<WDE_Transaction_ID> - Unique vendor system call/request transaction ID
//<Contact_Name> - Calling subscriber number
//<Event_Channel> - Subscriber request channel (Voice, Web, Viber, etc. - provided by the vendor)
//<Call_StartDate> - Call start date in YYYYMMDDHHMMSS format
//<Login_Id> - Contact center user login name
//
//Sample URL usage:
//https://servicehelper.mts.am/launch/123456789/93123456/Voice/202007151525/msukiasyan

$request = $_SERVER['REQUEST_URI'];
if($request[0] === '/') {
    $request = substr($request, 1);
}

//var_dump($request);

$requestParams = explode('/', $request);
if(count($requestParams) < 2 || strtolower($requestParams[0]) !== 'launch') {

    echo "<h2 style='color: red;'>Illegal redirection request</h2>";
}
else { // parse params

    $paramsCount = count($requestParams) - 1;

    echo "<h2>{$paramsCount} parameters passed via the redirection link:</h2>";

    $params['WDE transaction ID'] = $requestParams[1];

    if(isset($requestParams[2])) $params['Contact Name (Calling Subscriber Number)'] = $requestParams[2];
    if(isset($requestParams[3])) $params['Event Channel'] = $requestParams[3];
    if(isset($requestParams[4])) { // parse DTTM

        $callStartDttm = DateTime::createFromFormat("YmdHis", $requestParams[4]);
        if($callStartDttm === false) {
            $parsedCallStartDttm = "<span style='color: red'> (Invalid datetime format, use YYYYMMDDHHMMSS)</span>";
        }
        else {
            $parsedCallStartDttm = '(Date: ' . $callStartDttm->format("d/m/Y") . ', Time: ' . $callStartDttm->format("H:i:s"). ')';
        }

        $params['Call Start Date'] = $requestParams[4] . ' ' . $parsedCallStartDttm;
    }
    if(isset($requestParams[5])) $params['Login ID (Contact center user)'] = $requestParams[5];


    foreach ($params as $paramName => $paramValue) {

        echo "<h3><span style='color: steelblue'>{$paramName} => </span><span style='color: limegreen;'>{$paramValue}<span></h3>";

    }

}
