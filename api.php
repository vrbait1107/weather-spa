<?php

require_once('config.php');

if (!empty($_POST['location'])) {

    $location = htmlspecialchars($_POST['location']);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.weatherapi.com/v1/forecast.json?key={$key}&q={$location}&days=7&aqi=no&alerts=no",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    if ($response == false) {
        $error_message = 'Something Went Wrong';
    } else {
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($http_code >= 400) {
            $errorResponse = json_decode($response, true);
            $error_message = $errorResponse['error']['message'] ?? 'No Data Found for this Location';
        } else {
            $data = json_decode($response, true);
        }
    }

    curl_close($curl);
} else {
    $error_message = 'Please provide a location.';
}

if (isset($error_message)) {
    echo '<div class="alert alert-danger text-center">' . $error_message . '</div>';
    exit;
}

?>

<div class="row mx-auto">
    <div class="col-md-4 card date-div mb-5 p-2 text-center">
        <h5>Current Day, Date & Time</h5>
        <p><?php echo date('d M Y h:i A', strtotime($data['location']['localtime'] ?? '')) ?></p>
    </div>

    <div class="col-md-4 card temperat mb-5 temperature-div p-2 text-center">
        <h5>Temperature</h5>
        <p><img src="<?php echo $data['current']['condition']['icon'] ?? ''; ?>" style="height: 25px;width: 25px;"> <?php echo ($data['current']['temp_c'] ?? '') . " °C"; ?> </p>
        <p><?php echo $data['current']['condition']['text'] ?? ''; ?></p>
    </div>

    <div class="col-md-4 card mb-5 location-div p-2 text-center">
        <h5>Location</h5>
        <p><?php echo $data['location']['name'] ?? ''; ?></p>
    </div>
</div>

<div class="row mx-auto">
    <?php foreach ($data['forecast']['forecastday'] as $value) : ?>
        <div class="col-md-2 card p-3 mb-5 text-center">
            <h5><?php echo date('d M Y', strtotime($value['date'])) ?? ''; ?></h5>
            <p><img src="<?php echo $value['day']['condition']['icon'] ?? ''; ?>" style="height: 25px;width: 25px;"> <?php echo ($value['day']['avgtemp_c'] ?? "NA") . " °C"; ?></p>
            <p><?php echo $value['day']['condition']['text'] ?? ''; ?></p>
        </div>
    <?php endforeach ?>
</div>