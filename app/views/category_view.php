<?php
if (!empty($data['wikis'])) {
    $wikis = $data['wikis'];
}
if (!empty($data['categories'])) {
    $category = $data['categories'];
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

        <div id="container" class="flex flex-col items-center gap-4">
            <div id="content" class="flex flex-col gap-6 justify-start w-[90%] md:w-4/5 mx-auto min-h-[90vh]">
                <p class="text-3xl font-semibold"><?= $category ?></p>
                <div class="flex flex-col items-center lg:flex-row lg:items-start justify-center gap-4 w-full h-full pt-2">
                <div class="dark:bg-white-800 dark:text-gray-100 w-full h-full">
                        <div class="container max-w-6xl p-2 pt-0 mx-auto space-y-6 sm:space-y-12 w-full h-full">
                            <?php if (!isset($wikis)) { ?>
                                <p class="w-full h-full flex items-center justify-center text-xl font-medium text-black">No wikis found</p>
                            <?php } else { ?>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                    <?php foreach ($wikis as $wiki) {  ?>
                                        <a href="<?= CONTROOT ?>wiki/<?= $wiki->getId() ?>" class="group w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out">
                                            <?php if ($wiki->getImage() == null) { ?>
                                                <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/wiki_logo.png" alt="Wiki Image">
                                            <?php } else { ?>
                                                <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/<?= $wiki->getImage() ?>" alt="Wiki Image">
                                            <?php } ?>
                                            <div class="p-4">
                                                <div class="flex items-center mb-2">
                                                    <img class="w-6 h-6 rounded-full" src="<?= ROOT ?>assets/images/profile/default_profile.png" alt="user profile image">
                                                    <p class="ml-2 text-sm text-gray-400"><?= $wiki->getAuthor()->getName() ?></p>
                                                </div>
                                                <?php if (strlen($wiki->getName()) > 14) { ?>
                                                    <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline"><?= substr($wiki->getName(), 0, 12) ?>...</h2>
                                                <?php } else { ?>
                                                    <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline"><?= $wiki->getName() ?></h2>
                                                <?php } ?>
                                                <?php if (strlen($wiki->getDesc()) > 35) { ?>
                                                    <p class="mt-2 text-black"><?= substr($wiki->getDesc(), 0, 35) ?>...</p>
                                                <?php } else { ?>
                                                    <p class="mt-2 text-black"><?= $wiki->getDesc() ?></p>
                                                <?php } ?>
                                                <span class="text-xs text-gray-700"><?= $wiki->getDate() ?></span>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="categories" class="flex flex-col gap-6 w-[90%] md:w-4/5 mx-auto min-h-[90vh] hidden">

            </div>
            <div id="tags" class="flex flex-col gap-6 w-[90%] md:w-4/5 mx-auto min-h-[90vh] hidden">

            </div>

        </div>
        <?php require_once 'components/footer.php' ?>
    </div>
</body>

</html>