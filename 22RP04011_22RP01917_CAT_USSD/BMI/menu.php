<?php
include_once 'Util.php';
include_once 'sms.php';

class Menu {
    protected $text;
    protected $sessionId;
    protected $util;
    protected $phoneNumber;

    function __construct() {
        $this->util = new Util();
    }

    public function mainMenuUnregistered() {
        $response = "CON Welcome to BMI SERVICE\n";
        $response .= "1. Register\n";
        echo $response;
    }

    public function mainMenuRegistered() {
        $response = "CON Welcome back to BMI SERVICE\n";
        $response .= "1. Check your BMI\n";
        echo $response;
    }

    public function menuRegister($textArray, $phoneNumber) {
        $level = count($textArray);

        if ($level == 1) {
            echo "CON Enter your Full Name\n";
            echo Util::$GO_BACK . ". Back\n";
            echo Util::$GO_TO_MAIN_MENU . ". Main Menu\n";
        } else if ($level == 2) {
            echo "CON Enter your PIN\n";
            echo Util::$GO_BACK . ". Back\n";
            echo Util::$GO_TO_MAIN_MENU . ". Main Menu\n";
        } else if ($level == 3) {
            echo "CON Re-enter your PIN\n";
            echo Util::$GO_BACK . ". Back\n";
            echo Util::$GO_TO_MAIN_MENU . ". Main Menu\n";
        } else if ($level == 4) {
            $fullname = $textArray[1];
            $pin = $textArray[2];
            $confirm = $textArray[3];

            if ($pin !== $confirm) {
                echo "END PINs do not match. Please try again.";
                return;
            }

            $isRegistered = $this->util->isUserRegistered($phoneNumber);
            if ($isRegistered) {
                echo "END You are already registered.";
                return;
            }

            $success = $this->util->registerUser($fullname, $phoneNumber, $pin);
            if ($success) {
                $message = "Hello $fullname, you have successfully registered for BMI Service.";
                $sms = new Sms($phoneNumber);
                $res = $sms->sendSMS($message, $phoneNumber);

                if (isset($res['status']) && strtolower($res['status']) === 'success') {
                    echo "END Registration successful! You will receive an SMS shortly.";
                } else {
                    echo "END Registered, but SMS failed to send.";
                }
            } else {
                echo "END Registration failed. Try again.";
            }
        }
    }

    public function menuCheckBMI($textArray, $phoneNumber) {
        $level = count($textArray);

        if ($level == 1) {
            echo "CON Enter your height in meters (e.g. 1.75)";
        } else if ($level == 2) {
            echo "CON Enter your weight in KG";
        } else if ($level == 3) {
            $height = floatval($textArray[1]);
            $weight = floatval($textArray[2]);

            if ($height <= 0 || $weight <= 0) {
                echo "END Invalid height or weight entered.";
                return;
            }

            echo "CON You entered:\n";
            echo "Height: $height m\n";
            echo "Weight: $weight kg\n";
            echo "1. Confirm and calculate BMI\n";
            echo "2. Cancel session\n";
            echo "3. Re-enter weight\n";
            echo "4. Main Menu";
        } else if ($level == 4) {
            $height = floatval($textArray[1]);
            $weight = floatval($textArray[2]);
            $option = $textArray[3];

            switch ($option) {
                case "1":
                    if ($height <= 0 || $weight <= 0) {
                        echo "END Invalid inputs.";
                        return;
                    }

                    $bmi = round($weight / ($height * $height), 2);
                    $status = "";
                    $recommendation = "";

                    if ($bmi < 18.5) {
                        $status = "Underweight";
                        $recommendation = "Consider a balanced diet to gain weight.";
                    } else if ($bmi < 25) {
                        $status = "Normal weight";
                        $recommendation = "Keep up the good health!";
                    } else if ($bmi < 30) {
                        $status = "Overweight";
                        $recommendation = "Consider regular exercise and healthy eating.";
                    } else {
                        $status = "Obese";
                        $recommendation = "Please consult a healthcare provider.";
                    }

                    $smsText = "Your BMI is $bmi ($status). $recommendation";
                    $sms = new Sms($phoneNumber);
                    $res = $sms->sendSMS($smsText, $phoneNumber);

                    if (isset($res['status']) && strtolower($res['status']) === 'success') {
                        echo "END Your BMI is $bmi ($status). SMS sent!";
                    } else {
                        echo "END Your BMI is $bmi ($status). SMS failed to send.";
                    }
                    break;

                case "2":
                    echo "END Session cancelled.";
                    break;

                case "3":
                    echo "CON Re-enter your weight in KG";
                    break;

                case "4":
                    $this->mainMenuRegistered();
                    break;

                default:
                    echo "END Invalid option selected.";
            }
        }
    }

    public function middleware($text) {
        return $this->goBack($this->goToMainMenu($text));
    }

    function goBack($text) {
        $explodedText = explode("*", $text);
        while (array_search(Util::$GO_BACK, $explodedText) !== false) {
            $i = array_search(Util::$GO_BACK, $explodedText);
            array_splice($explodedText, $i - 1, 2);
        }
        return join("*", $explodedText);
    }

    function goToMainMenu($text) {
        $explodedText = explode("*", $text);
        while (array_search(Util::$GO_TO_MAIN_MENU, $explodedText) !== false) {
            $i = array_search(Util::$GO_TO_MAIN_MENU, $explodedText);
            $explodedText = array_slice($explodedText, $i + 1);
        }
        return join("*", $explodedText);
    }
}
?>
