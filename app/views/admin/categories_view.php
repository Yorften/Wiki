<?php
if (!empty($data['msg'])) {
    $msg = $data['msg'];
}
if (!empty($data['categories'])) {
    $categories = $data['categories'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(__DIR__ . '/../components/head.php') ?>
</head>

<body>
    <?php require_once 'components/category_popups.php' ?>
    <div class="flex flex-col justify-end items-start h-[100vh]">
        <div class="flex justify-between items-center w-full md:px-8">
            <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl">Categories</p>

            <?php
            if (isset($msg)) {
                if ($msg == 1) {
                    echo '<div class="bg-green-500 px-2 rounded-lg top-24 w-full absolute md:w-[50%] md:static">';
                    echo '<p class="text-white text-base md:text-lg text-center">Category added successfully!</p>';
                    echo '</div>';
                } elseif ($msg == 2) {
                    echo '<div class="bg-green-500 px-2 rounded-lg top-24 w-full absolute md:w-[50%] md:static">';
                    echo '<p class="text-white text-base md:text-lg text-center">Category modified successfully!</p>';
                    echo '</div>';
                } elseif ($msg == 3) {
                    echo '<div class="bg-green-500 px-2 rounded-lg top-24 w-full absolute md:w-[50%] md:static">';
                    echo '<p class="text-white text-base md:text-lg text-center">Category deleted successfully!</p>';
                    echo '</div>';
                } else {
                    echo '<div class="bg-red-500 px-2 rounded-lg top-24 w-full absolute md:w-[50%] md:static">';
                    echo '<p class="text-white text-base md:text-lg text-center">' . $msg . '</p>';
                    echo '</div>';
                }
            }
            ?>

            <button onclick="openPopup()" class="p-2 pb-1 bg-blue-500 text-white rounded-md">Add Category +</button>
        </div>
        <div class="border-2 border-gray-300 rounded-xl w-full h-[90vh] flex">
            <div id="categories" class="flex flex-col justify-center items-center w-full h-full p-1 md:p-4">
                <div class="container w-full lg:w-[95%] mx-auto px-2">
                    <div id='recipients' class="p-2 pb-8 rounded shadow-xl bg-white">
                        <?php if (!isset($categories)) { ?>
                            <p class="w-full h-full flex items-center justify-center">No categories found</p>
                        <?php } else { ?>
                            <table id="table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th data-priority="1">Id</th>
                                        <th data-priority="2">Name</th>
                                        <th data-priority="3">Last modified</th>
                                        <th data-priority="4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <p></p>

                                    <?php foreach ($categories as $category) { ?>
                                        <tr>
                                            <th><?= $category->getId() ?></th>
                                            <th id="categoryName<?= $category->getId() ?>"><a href="<?= CONTROOT ?>category/<?= $category->getName() ?>" target="_blank"><?= $category->getName() ?></a></th>
                                            <th><?= $category->getDate() ?></th>
                                            <th>
                                                <div class="mx-auto flex items-center justify-evenly w-full gap-10">
                                                    <button onclick="showCategoryDetails(<?= $category->getId() ?>)" class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-200 shadow-lg text-sm font-medium rounded-md">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                        </svg>

                                                        Modify
                                                    </button>
                                                    <form method="post">
                                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                        <input type="hidden" name="categoryId" value="<?= $category->getId() ?>">
                                                        <button type="submit" name="delete" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 shadow-lg text-white text-sm font-medium rounded-md">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>

                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </th>
                                        </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'components/datatables.php' ?>
    <script src="<?= ROOT ?>assets/js/regex_categories.js"></script>
</body>

</html>