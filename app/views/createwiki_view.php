<?php
if (!empty($data['msg'])) {
    $msg = $data['msg'];
}
if (!empty($data['tags'])) {
    $tags = $data['tags'];
}
if (!empty($data['categories'])) {
    $categories = $data['categories'];
}

?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once('components/head.php') ?>
    <title>Create wiki | Wiki</title>

</head>

<body class="overflow-x-hidden">
    <div class="flex flex-col gap-14 justify-start min-h-screen">
        <?php require_once 'components/nav.php' ?>

        <div id="container">
            <div id="content" class="flex flex-col gap-8 justify-start w-[90%] md:w-4/5 mx-auto min-h-[30vh]">
                <div class="w-[95%] md:w-3/4 mx-auto p-2 text-center bg-red-500 rounded-lg text-white hidden">
                    <p id="error"></p>
                </div>
                <form method="POST" enctype="multipart/form-data" class="flex flex-col gap-2 justify-around items-center h-full">
                    <div class="flex flex-col w-full">
                        <input type="text" name="title" id="title" placeholder="Title" class="p-1 w-[95%] md:w-3/4 shadow-lg border-t-2 rounded-lg mx-auto">
                        <div id="titleErr" class="text-red-600 text-sm font-medium pl-3 w-[95%] md:w-3/4 mx-auto"></div>
                    </div>
                    <div class="flex flex-col w-full">
                        <input type="text" name="title" id="desc" placeholder="Description" class="p-1 w-[95%] md:w-3/4 shadow-lg border-t-2 rounded-lg mx-auto">
                        <div id="descErr" class="text-red-600 text-sm font-medium pl-3 w-[95%] md:w-3/4 mx-auto"></div>
                    </div>
                    <div class="flex flex-col w-full">
                        <textarea name="content" id="wikicontent" cols="30" rows="19" placeholder="Article content" class="w-[95%] md:w-3/4 shadow-md p-1 border-t-2 rounded-lg mx-auto"></textarea>
                        <div id="contentErr" class="text-red-600 text-sm font-medium pl-3 w-[95%] md:w-3/4 mx-auto"></div>
                    </div>
                    <div class="w-[95%] md:w-3/4 mx-auto flex items-center justify-between">
                        <div class="flex flex-col w-1/3">
                            <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                                <p class="text-xs">Wiki image</p>
                                <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="image" type="file" name="wikiImage" autocomplete="off">
                            </div>
                            <div id="wikiImageErr" class="text-red-600 text-xs pl-3"></div>
                        </div>
                        <select id="category" class="block leading-5 text-gray-700 bg-white focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-300 w-[60%] h-[40px] font-medium">
                            <option value="" selected hidden>Select a category</option>
                            <?php if (!isset($categories)) { ?>
                                <option value="" disabled>No categories found</option>
                                <?php } else {
                                foreach ($categories as $category) { ?>
                                    <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="w-[95%] md:w-3/4 mx-auto mt-4">
                        <p class="font-medium">Add tags</p>
                    </div>
                    <div class="w-[95%] md:w-3/4 mx-auto">
                        <select id="tagSelect" multiple>
                            <option value="" selected hidden>Select tags</option>
                            <?php if (!isset($tags)) { ?>
                                <option value="" disabled>No tags found</option>
                                <?php } else {
                                foreach ($tags as $tag) { ?>
                                    <option id="tag<?= $tag->getId() ?>" value="<?= $tag->getId() ?>"><?= $tag->getName() ?></option>
                            <?php }
                            } ?>
                        </select>
                    </div>
                    <div class="flex w-[95%] md:w-3/4 justify-between items-center mt-8">
                        <button id="create" class="w-full p-2 bg-blue-500 text-white text-center font-semibold text-lg rounded-md">Create Wiki</button>
                    </div>
                </form>
            </div>
            <div id="categories" class="flex flex-col gap-6 w-[90%] md:w-4/5 mx-auto min-h-[30vh] hidden">

            </div>
            <div id="tags" class="flex flex-col gap-6 w-[90%] md:w-4/5 mx-auto min-h-[30vh] hidden">

            </div>
        </div>
        <?php require_once 'components/footer.php' ?>
    </div>
    <script src="<?= ROOT ?>assets/js/create_wiki.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('tagSelect');
    </script>
    <script>
        var currentUrl = window.location.href;

        var queryString = currentUrl.split('?')[1];

        value = queryString.split('=');
        value = value[1];

        document.getElementById('category').value = value;
        

    </script>
</body>

</html>