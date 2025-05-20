<?php
include 'menu.php';

$sessionId   = $_POST['sessionId'] ?? '';
$phoneNumber = $_POST['phoneNumber'] ?? '';
$serviceCode = $_POST['serviceCode'] ?? '';
$text        = $_POST['text'] ?? '';

$util = new Util();
$menu = new Menu();

$text = $menu->middleware($text);
$isRegistered = $util->isUserRegistered($phoneNumber);

if ($text == "" && !$isRegistered) {
    $menu->mainMenuUnregistered();
} else if ($text == "" && $isRegistered) {
    $menu->mainMenuRegistered();
} else {
    $textArray = explode("*", $text);

    if (!$isRegistered) {
        switch ($textArray[0]) {
            case 1:
                $menu->menuRegister($textArray, $phoneNumber);
                break;
            default:
                echo "END Invalid option, Retry.";
        }
    } else {
        switch ($textArray[0]) {
            case 1:
                $menu->menuCheckBMI($textArray, $phoneNumber); // ✅ Corrected line
                break;
            default:
                echo "END Invalid choice.";
        }
    }
}
?>
