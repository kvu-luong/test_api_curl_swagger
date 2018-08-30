<?php

$header =  array(
    'accept: text/plain',
    'authorization: Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IjkyMzNERkVERkQ2RUREOEJCQzBBOTI3MjVGQ0EwOTJDNDUzOTdFNEIiLCJ0eXAiOiJKV1QiLCJ4NXQiOiJralBmN2YxdTNZdThDcEp5WDhvSkxFVTVma3MifQ.eyJuYmYiOjE1MzU2NTE4OTgsImV4cCI6MTUzNTY1NTQ5OCwiaXNzIjoiaHR0cDovL2lkZW50aXR5c2VydmVyLml0am9icy5kZW1vLnRvZy5jb20udm4iLCJhdWQiOlsiaHR0cDovL2lkZW50aXR5c2VydmVyLml0am9icy5kZW1vLnRvZy5jb20udm4vcmVzb3VyY2VzIiwiaXRqb2JzIl0sImNsaWVudF9pZCI6Iml0am9ic3N3YWdnZXJ1aSIsInN1YiI6IjU0NmRmY2Q2LTc0YmMtNDMzZi05MzA1LTg3MzUxZWZmYWUwMCIsImF1dGhfdGltZSI6MTUzNTY0MTQ5MiwiaWRwIjoibG9jYWwiLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiJsb2MubGVAdm4uZGV2aW5pdGlvbi5jb20iLCJuYW1lIjoiTG9jIiwibGFzdF9uYW1lIjoiTGUiLCJhZGRyZXNzX2NpdHkiOiJUYW4gQmluaCIsImFkZHJlc3NfY291bnRyeSI6IlZpZXRuYW0iLCJhZGRyZXNzX3N0YXRlIjoiSG8gQ2hpIE1pbmgiLCJhZGRyZXNzX3N0cmVldCI6IjIyNyBIb2FuZyBIb2EgVGhhbSIsImFkZHJlc3NfemlwX2NvZGUiOiI3MzAwMDAiLCJlbWFpbCI6ImxvYy5sZUB2bi5kZXZpbml0aW9uLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwicGhvbmVfbnVtYmVyIjoiKzg0MTI2NzM3NDcyNCIsInBob25lX251bWJlcl92ZXJpZmllZCI6ZmFsc2UsInNjb3BlIjpbIml0am9icyJdLCJhbXIiOlsicHdkIl19.GQbOlYithF3lNDZymSYAiRf0KMh_IFEPogF6IEmcnQQoYRXSkwL5Gj--NsLfFbpsNNufu8qWLDVJ70Ktk_2QUhnd1Zt0hle7mpfQLR8npsm_BBdYtd58MZifTcr9jQholuvCyy02AtEFXzs9PUILbL7XGaWiS9bzKmGKrNb5FpUi7nOugQj9YixmnXWiQAMzVnnuNktTii2NACZrCpnLokN2C1gTkTE-WTx6vCoKUUifAuwL5olyaqW02rewt1HWXSAHTWD6m8UQAkIwcPp5NNewvWVI32ZXnlUZzbwAEHKNzlm0LBMaarTwXqQRNnsEsSbM_ToU8UnrwA0ycyGZSA'
);
$tag = array(
    "jobTitle",
    "skillKeywordValues",
    "jobCompanyAddress",
    "maxSalary",
    "minSalary",
    "negotiable",
    "companyLogo"
);

//getRelevantKeyWords("php", 3, $header);
getJobDecriptions("php", 3, $header, $tag);
function getRelevantKeyWords($keyword, $limit, $header){
    $url = "http://api.itjobs.demo.tog.com.vn/api/v1/Dropdowns/keywords?keyword=".$keyword."&maxSize=".$limit;
    $output = initialCurl($header, $url);
    for ($x = 0; $x < count($output); $x++) {
        echo '<br/>'. $output[$x]. '<br />';
   }
}
function getJobDecriptions($keyword, $maximumSize, $header, $tag){
    $url = "http://api.itjobs.demo.tog.com.vn/api/v1/Jobs?Keyword=".$keyword."&Limit=".$maximumSize;
    $output = initialCurl($header, $url);
    for ($x = 0; $x < count($output); $x++) {
        for($y = 0 ; $y < count($tag); $y++){
            echo '<br/>'. $output[$x][$tag[$y]] . '<br />';
        }
        
   }
}


function initialCurl($header, $url){
    //  Initiate curl
    $ch = curl_init();
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result = curl_exec($ch);
    // Closing
    curl_close($ch);
    // Will dump a beauty json :3
    $output = json_decode($result, true);
    return $output;
}

?>