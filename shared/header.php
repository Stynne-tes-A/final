<?php
if (!isset($title)) {
    $title = "Momento";
    $keywords = "Share your moments with momento";
}
$description = "Share your moments with momento";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <meta name="keywords" content="<?= $keywords; ?>">
    <meta name="description" content="<?= $description; ?>">
    <meta name="author" content="stynne">>
    <link rel="shortcut icon" href="<?php url_for('public/assets/images/logo/logo.png') ?>">
    <link rel="stylesheet" href="<?= url_for('public/css/master.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>