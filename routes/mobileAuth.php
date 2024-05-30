<?php
include_once ('../includes/connection.php');
// Assuming you have a database connection established
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    if (strlen($mobile) != 10 || !ctype_digit($mobile)) {
        echo "Invalid mobile number.";
    } else {
        $preSQL = "SELECT * FROM `users` WHERE `mobile` = '$mobile'";
        $querySQL = mysqli_query($conn, $preSQL);
        $count = mysqli_num_rows($querySQL);
        if ($count == "0") {
            $date = date('Y-m-d');
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $sql = "INSERT INTO `users`(`id`, `full_name`, `email`, `mobile`, `password`, `sign_up_date`, `ip_address`, `permissions`) VALUES (null,'','','$mobile','','$date','$ip_address', '0')";
            $rows = mysqli_query($conn, $sql);
            $lastID = mysqli_insert_id($conn);

            $updateSQL = "UPDATE `otps` SET `expiry`='1' WHERE `userID` = '$lastID'";
            $updateQuery = mysqli_query($conn, $updateSQL);

            $random_number = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

            //Generating OTP
            $curl = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=zUcBVJ4fNgq7bWLESOIxmlrDiyTPsQ3uMtjhkdoRCFv5wYpXa2xhprVatY8cLgbCKqT2oRHvluisSX6m&variables_values=$random_number&route=otp&numbers=" . urlencode($mobile),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache"
                    ),
                )
            );
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }
            //End Of Generating OTP


            $sql2 = "INSERT INTO `otps`(`id`, `userID`, `otp`, `expiry`) VALUES (null,'$lastID','$random_number','0')";
            $query2 = mysqli_query($conn, $sql2);
        } else {
            $postSQL = "SELECT * FROM `users` WHERE `mobile` = '$mobile'";
            $postSQL = mysqli_query($conn, $postSQL);
            $row = mysqli_fetch_array($postSQL);
            $lastID = $row['id'];
            $updateSQL = "UPDATE `otps` SET `expiry`='1' WHERE `userID` = '$lastID'";
            $updateQuery = mysqli_query($conn, $updateSQL);

            $random_number = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);


            //Generating OTP
            $curl = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=zUcBVJ4fNgq7bWLESOIxmlrDiyTPsQ3uMtjhkdoRCFv5wYpXa2xhprVatY8cLgbCKqT2oRHvluisSX6m&variables_values=$random_number&route=otp&numbers=" . urlencode($mobile),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache"
                    ),
                )
            );
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }
            //End Of Generating OTP

            $sql2 = "INSERT INTO `otps`(`id`, `userID`, `otp`, `expiry`) VALUES (null,'$lastID','$random_number','0')";
            $query2 = mysqli_query($conn, $sql2);
        }
    }
}