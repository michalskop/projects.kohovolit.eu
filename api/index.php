<?php
# API proxy for darujme.cz

error_reporting(0);

$settings = json_decode(file_get_contents("./settings.json"));
$url = "https://www.darujme.cz/api/v1/organization/" . $settings->organization . "/pledges-by-filter?apiId=" . $settings->apiId . "&apiSecret=" . $settings->apiSecret . "&projectId=" . $_GET['projectId'];
$pledges = json_decode(file_get_contents($url));
$success = ["success", "success_money_on_account", "sent_to_organization"];
$supporters = [];
foreach($pledges->pledges as $s) {
    $support = false;
    foreach($s->transactions as $t) {
        if (in_array($t->state, $success)) {
            $support = true;
        }
    }
    if ($support) {
        // print_r($s);
        $last_transaction = array_slice($s->transactions, -1)[0];
        $supporters[] = ["given_name" => $s->donor->firstName, "family_name" => $s->donor->lastName, "date" => $last_transaction->receivedAt, "amount" => $last_transaction->outgoingAmount->cents];
    }
}

// API call
// CORS https://stackoverflow.com/a/25661403/1666623
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json; charset=utf-8');
echo json_encode($supporters);

 ?>
