<?php
$wikis = $categories = $tags = $users = 0;

if (!empty($data['wikis'])) {
    $wikis = $data['wikis'];
}
if (!empty($data['categories'])) {
    $categories = $data['categories'];
}
if (!empty($data['users'])) {
    $users = $data['users'];
}
if (!empty($data['tags'])) {
    $tags = $data['tags'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(__DIR__ . '/../components/head.php') ?>
</head>

<body>
    <div class="flex flex-wrap w-full justify-center min-h-screen bg-gray-100 p-8">
        <div class="mx-auto mt-4">
            <div class="w-56 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100">
                <div class="h-20 bg-red-400 flex items-center justify-between">
                    <p class="mr-0 text-white text-lg pl-5">Authors</p>
                </div>
                <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                    <p>TOTAL</p>
                </div>
                <p class="py-4 text-3xl ml-5"><?= $users ?></p>
                <!-- <hr > -->
            </div>
        </div>

        <a href="<?= CONTROOT ?>wikis" class="mx-auto mt-4">
            <div class="w-56 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100">
                <div class="h-20 bg-blue-500 flex items-center justify-between">
                    <p class="mr-0 text-white text-lg pl-5">Wikis</p>
                </div>
                <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                    <p>TOTAL</p>
                </div>
                <p class="py-4 text-3xl ml-5"><?= $wikis ?></p>
                <!-- <hr > -->
            </div>
        </a>

        <a href="<?= CONTROOT ?>categories" class="mx-auto mt-4">
            <div class="w-56 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100">
                <div class="h-20 bg-purple-400 flex items-center justify-between">
                    <p class="mr-0 text-white text-lg pl-5">Categories</p>
                </div>
                <div class="flex justify-between pt-6 px-5 mb-2 text-sm text-gray-600">
                    <p>TOTAL</p>
                </div>
                <p class="py-4 text-3xl ml-5"><?= $categories ?></p>
                <!-- <hr > -->
            </div>
        </a>

        <a href="<?= CONTROOT ?>tags" class="mx-auto mt-4">
            <div class="w-56 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100">
                <div class="h-20 bg-purple-900 flex items-center justify-between">
                    <p class="mr-0 text-white text-lg pl-5">Tags</p>
                </div>
                <div class="flex justify-between pt-6 px-5 mb-2 text-sm text-gray-600">
                    <p>TOTAL</p>
                </div>
                <p class="py-4 text-3xl ml-5"><?= $tags ?></p>
                <!-- <hr > -->
            </div>
        </a>
    </div>
</body>

</html>