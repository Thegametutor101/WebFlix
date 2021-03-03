<?php
require_once(__DIR__.'/DB/Model/ModelAccounts.php');
require_once(__DIR__.'/DB/Entity/EntityAccounts.php');
$modelAccounts = new ModelAccounts();
$entityAccounts = new EntityAccounts();
$path = $_FILES['profile']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);
$profileDirectory = dirname(__FILE__) . '/../ressources/assets/images/profilePictures/' .
    hash(hash_algos()[9], $_POST['email'], false) . "." . $ext;
// Remove previous profile image from assets
$account = $entityAccounts->getAccountByEmail($_POST['email']);
try {
    unlink(dirname(__FILE__) . '/../' .
        substr($account[4], strpos($account[4], "ressources")));
}catch (ErrorException $e) {
    echo json_encode(array("message" => "file delete error"));
}
// Add new image
if (!move_uploaded_file($_FILES['profile']['tmp_name'], $profileDirectory)) {
    echo json_encode(array("message" => "file upload error"));
} else {
    $modelAccounts->updateProfile($_POST['email'], $profileDirectory);
    echo json_encode(array("message" => "ok",
        "link" => substr($profileDirectory, strpos($profileDirectory, "ressources"))));
}