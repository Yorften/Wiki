<?php

if (!empty($data['categories'])) {
    $categories = $data['categories'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once('components/head.php') ?>
    <title>Categories | Wiki</title>

</head>

<body class="overflow-x-hidden">
    <div class="flex flex-col gap-8 justify-start min-h-screen">
        <?php require_once 'components/nav.php' ?>

        <div id="container" class="flex flex-col items-center gap-4">
            <div id="content" class="flex flex-col gap-6 justify-start w-[90%] md:w-4/5 mx-auto min-h-[50vh]">
                <p class="text-3xl font-semibold">All Categories</p>

                <?php if (!isset($categories)) { ?>
                    <p class="w-full h-full flex items-center justify-center text-xl font-medium text-black">No wikis found</p>
                <?php } else { ?>
                    <div class="grid gap-2 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 mt-8">
                        <?php foreach ($categories as $category) { ?>
                            <a href="<?= CONTROOT ?>category/<?= $category->getName() ?>" class="text-center underline text-blue-600 font-semibold text-lg"><?= $category->getName() ?></a>
                        <?php } ?>
                    </div>
                <?php   } ?>
            </div>
            <div id="categories" class="flex flex-col gap-6 w-[90%] md:w-4/5 mx-auto min-h-[30vh] hidden">

            </div>
            <div id="tags" class="flex flex-col gap-6 w-[90%] md:w-4/5 mx-auto min-h-[30vh] hidden">

            </div>

        </div>
        <?php require_once 'components/footer.php' ?>
    </div>
</body>

</html>