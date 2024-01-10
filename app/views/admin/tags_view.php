<?php
if (!empty($data['msg'])) {
    $msg = $data['msg'];
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
    <?php require_once 'components/tag_popups.php' ?>
    <div class="flex flex-col justify-end items-start h-[100vh]">
        <div class="flex justify-between items-center w-full md:px-8">
            <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl">Tags</p>
            <?php
            if (isset($msg)) {
                if ($msg == 1) {
                    echo '<div class="bg-green-500 px-2 rounded-lg top-24 absolute md:static">';
                    echo '<p class="text-white text-base md:text-lg text-center">Tag added successfully!</p>';
                    echo '</div>';
                } elseif ($msg == 2) {
                    echo '<div class="bg-green-500 px-2 rounded-lg top-24 absolute md:static">';
                    echo '<p class="text-white text-base md:text-lg text-center">Tag modified successfully!</p>';
                    echo '</div>';
                } elseif ($msg == 3) {
                    echo '<div class="bg-green-500 px-2 rounded-lg top-24 absolute md:static">';
                    echo '<p class="text-white text-base md:text-lg text-center">Tag deleted successfully!</p>';
                    echo '</div>';
                } else {
                    foreach ($msg as $error) {
                        echo '<div class="bg-red-500 px-2 rounded-lg top-24 absolute md:static">';
                        echo '<p class="text-white text-base md:text-lg text-center">' . $error . '</p>';
                        echo '</div>';
                    }
                }
            }
            ?>

            <button onclick="openPopup()" class="p-2 pb-1 bg-blue-500 text-white rounded-md">Add Tag +</button>
        </div>
        <div class="border-2 border-gray-300 rounded-xl w-full h-[90vh] flex">
            <div id="tags" class="flex flex-col justify-center items-center w-full h-full p-1 md:p-4">
                <!-- <p class="w-full h-full flex items-center justify-center">No client accounts in database</p> -->
                <div class="container w-full md:w-11/12 lg:w-[95%] xl:w-3/5 mx-auto px-2">
                    <div id='recipients' class="pb-8 rounded shadow-xl bg-white">
                        <table id="table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                            <thead>
                                <tr>
                                    <th data-priority="1">Id</th>
                                    <th data-priority="2">Name</th>
                                    <th data-priority="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- loop -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'components/datatables.php' ?>
    <script src="<?= ROOT ?>assets/js/regex_tags.js"></script>

</body>

</html>