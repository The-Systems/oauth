<?php
$client_id = "CLIENTID";
$client_secret = "CLIENTSECRET";
$redirect_uri = "REDIRECTURI";
$scope = "basic email";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_GET["error"])) {
    echo json_encode(array("message" => "Authorization Error"));
} elseif (isset($_GET["code"])) {
    $token_request = "https://oauth.the-systems.eu/token.php";
    $token = curl_init();
    curl_setopt_array($token, array(
        CURLOPT_URL => $token_request,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => array(
            "grant_type" => "authorization_code",
            "client_id" => $client_id,
            "client_secret" => $client_secret,
            "redirect_uri" => $redirect_uri,
            "code" => $_GET["code"]
        )
    ));
    curl_setopt($token, CURLOPT_RETURNTRANSFER, true);
    $resp = json_decode(curl_exec($token));
    curl_close($token);

    if (isset($resp->access_token)) {
        $refresh_token = $resp->refresh_token;
        $access_token = $resp->access_token;
        $info_request = "https://oauth.the-systems.eu/api/userinfo/index.php";
        $info = curl_init();

        curl_setopt_array($info, array(
            CURLOPT_URL => $info_request,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "access_token=" . $access_token,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));
        curl_setopt($info, CURLOPT_RETURNTRANSFER, true);
        $inforesp = json_decode(curl_exec($info));
        curl_close($info);


        echo '<h4>Willkommen, ' . $inforesp->nickname . '</h4><h5>E-Mail: ' . $inforesp->email . '</h5><img src="' . $inforesp->profilpic . '"</img><p>Refreshtoken: ' . $refresh_token . '</p>';


    } else {
        echo json_encode(array("message" => "Authentication Error"));
    }
} else {
    header("Location: http://oauth.the-systems.eu/authorize.php?response_type=code&client_id=" . $client_id . "&state=xyz&scope=" . rawurlencode($scope) . "&redirect_uri=" . $redirect_uri);
    echo json_encode(array("message" => "No Code Provided"));
}
?>