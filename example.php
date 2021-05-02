<?php
$client_id = "CLIENTID";
$client_secret = "CLIENTSECRET";
$redirect_uri = "REDIRECTURI";
$scope = "basic email";
$state = "login";


$url_token = "https://oauth2.the-systems.eu/oauth/token";
$url_resource = "https://oauth2.the-systems.eu/oauth/resource/user";
$url_auth = "https://oauth2.the-systems.eu/oauth/authorize";

if (isset($_GET["error"])) {
    echo json_encode(array("message" => "Authorization Error"));
} elseif (isset($_GET["code"])) {
    $token = curl_init();
    curl_setopt_array($token, array(
        CURLOPT_URL => $$url_token,
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
        $info = curl_init();
        curl_setopt_array($info, array(
            CURLOPT_URL => $url_resource,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$access_token,
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));
        curl_setopt($info, CURLOPT_RETURNTRANSFER, true);
        $inforesp = json_decode(curl_exec($info));
        curl_close($info);
		if (isset($inforesp->error)) {
			echo json_encode(array("message" => "Request Error", "error" => $inforesp));
		} else {
			echo '<h4>Willkommen, ' . $inforesp->username . '</h4><h5>E-Mail: ' . $inforesp->email . '</h5><img src="' . $inforesp->icon . '"</img><p>Refreshtoken: ' . $refresh_token . '</p>';
		}

    } else {
        echo json_encode(array("message" => "Authentication Error", "error" => $resp));
    }
} else {
    header("Location: ".$url_auth."?response_type=code&client_id=" . $client_id . "&state=".$state."&scope=" . rawurlencode($scope) . "&redirect_uri=" . $redirect_uri);
    echo json_encode(array("message" => "No Code Provided"));
}
?>