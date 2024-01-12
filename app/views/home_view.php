<?php
if (!empty($data['wikis'])) {
    $wikis = $data['wikis'];
}
if (!empty($data['categories'])) {
    $categories = $data['categories'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once('components/head.php') ?>
    <title>Home | Wiki</title>

</head>

<body class="overflow-x-hidden">
    <div class="flex flex-col gap-8 justify-start min-h-screen">
        <?php require_once 'components/nav.php' ?>

        <div id="container">
            <div id="content" class="flex flex-col gap-6 justify-start w-[90%] md:w-4/5 mx-auto min-h-[90vh]">
                
            </div>
        </div>
        <?php require_once 'components/footer.php' ?>
    </div>
</body>

</html>