<?php
if (!empty($data['wikiDetails'])) {
    $wiki = $data['wikiDetails'];
}
if (!empty($data['wikiTags'])) {
    $tags = $data['wikiTags'];
}
if (!isset($_SESSION['userId'])) {
    $_SESSION['userId'] = null;
}

$wikiId = $data['wikiId'];


?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once('components/head.php') ?>
    <title><?= $wiki->getName() ?> | Wiki</title>

</head>

<body class="overflow-x-hidden">
    <input type="hidden" class="md:top-16 top-28 w-full md:w-[35%] md:mx-auto h-full border-t-2 hidden">
    <div id="popup" class="fixed w-full h-full top-0 left-0  items-center flex justify-center hidden z-50 bg-black/60">
        <div class="bg-white w-[90%] md:w-1/3 h-fit border-2 shadow-xl flex flex-col justify-start items-center overflow-y-auto rounded-2xl md:h-fit">
            <div class="w-[90%] md:w-1/3 h-8 fixed rounded-tr-2xl rounded-tl-2xl">
                <div class="flex justify-end">
                    <span onclick="closePopup()" class="text-2xl font-bold cursor-pointer mr-3">&times;</span>
                </div>
            </div>
            <div class="mt-14 mb-4 text-center mx-auto w-[90%] md:w-[80%]">
                <p><b>Deleting the article is a permanent action.</b> Reach out to our support team if you need assistance in reversing this process.</p>
            </div>
            <div class="flex items-center justify-evenly w-full my-4">
                <form method="post">
                    <button type="submit" name="archive" class="px-8 py-2 bg-gray-500 border border-gray-600 text-white font-semibold rounded-lg">Yes</button>
                </form>
                <button onclick="closePopup()" class="px-8 py-2 bg-gray-500 border border-gray-600 text-white font-semibold rounded-lg">No</button>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-8 justify-start min-h-screen">
        <?php require_once 'components/nav.php' ?>
        <div id="container">
            <div id="content" class="flex flex-col gap-8 justify-start w-[90%] md:w-4/5 mx-auto min-h-[30vh]">
                <input type="hidden" id="wikiId" value="<?= $wikiId ?>">
                <div class="w-full flex items-end justify-between border-b-2 p-2">
                    <h1 id="title2" class="text-xl font-semibold w-full"><?= $wiki->getName() ?></h1>
                    <?php if ($wiki->getAuthor()->getId() == $_SESSION['userId']) {
                    ?>
                        <div class="flex items-center justify-evenly w-40">
                            <button id="editwiki" class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-200 shadow-lg text-sm font-medium rounded-md">
                                Edit
                            </button>
                            <button onclick="openPopup()" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 shadow-lg text-white text-sm font-medium rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    <?php } else { ?>
                    <?php } ?>
                </div>
                <div class="flex flex-wrap items-center gap-2 w-full">
                    <?php if (!isset($tags)) { ?>
                        <p class="text-sm p-1 rounded-xl border border-gray-500 text-gray-500">No tags</p>
                        <?php } else {
                        foreach ($tags as $tag) { ?>
                            <p data-value="<?= $tag->getId() ?>" class="tags capitalize text-sm p-1 rounded-xl border border-gray-500 text-gray-500"><?= $tag->getName() ?></p>
                    <?php }
                    } ?>
                </div>
                <div class="flex flex-col-reverse items-center lg:flex-row lg:items-start justify-center gap-4 w-full h-full pt-2">
                    <div class="dark:bg-white-800 dark:text-gray-100 w-full h-full">
                        <div class="container max-w-6xl p-4 mx-auto space-y-6 sm:space-y-12 w-full h-full shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
                            <p id="wikiContent2" class="text-black font-medium"><?= str_replace('&#10;', "<br>", $wiki->getContent()) ?></p>
                        </div>
                    </div>
                    <div class="w-full lg:w-[35%] md:mx-auto h-full border-t-2">
                        <div class="flex flex-col gap-4 w-full h-full shadow-lg pb-4">
                            <?php if ($wiki->getImage() == null) { ?>
                                <img class="object-cover w-full lg:h-[154px] lg:w-[268px]" src="<?= ROOT ?>assets/images/wikis/wiki_logo.png" alt="">
                            <?php } else { ?>
                                <img class="object-cover w-full lg:h-[154px] lg:w-[268px]" src="<?= ROOT ?>assets/images/wikis/<?= $wiki->getImage() ?>" alt="">
                            <?php } ?>

                            <div class="flex flex-col justify-between pl-3 p-1">
                                <p class="font-semibold"><?= $wiki->getName() ?></p>
                                <p><span class="font-semibold">Description:</span><span id="desc2"><?= $wiki->getDesc() ?></span></p>
                                <p><span class="font-semibold">Author:</span> <?= $wiki->getAuthor()->getName() ?></p>
                                <p><span class="font-semibold">Category:</span> <a id="category" value="<?= $wiki->getCategory()->getId() ?>" href="<?= CONTROOT ?>category/<?= $wiki->getCategory()->getName() ?>"><?= $wiki->getCategory()->getName() ?></a></p>
                                <p><span class="font-semibold">Created at:</span> <?= $wiki->getDate() ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="categories" class="flex flex-col gap-6 w-[90%] md:w-4/5 mx-auto min-h-[30vh] hidden">

            </div>
            <div id="tags" class="flex flex-col gap-6 w-[90%] md:w-4/5 mx-auto min-h-[30vh] hidden">

            </div>
        </div>
        <?php require_once 'components/footer.php' ?>
    </div>
    <script src="<?= ROOT ?>assets/js/popup.js"></script>
    <script src="<?= ROOT ?>assets/js/edit_wiki.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script>
        function initMultiSelectTag() {
            new MultiSelectTag('tagSelect');
        }
    </script>
</body>

</html>