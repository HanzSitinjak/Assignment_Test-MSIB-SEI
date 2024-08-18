<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $judul; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('public/css/home.css'); ?>">
    <style>
        body {
            background-image: url('<?php echo base_url('public/assets/bg_hero.jpeg'); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 90vh;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>