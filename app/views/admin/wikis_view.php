<?php
if (!empty($data['msg'])) {
    $msg = $data['msg'];
}
if (!empty($data['wikis'])) {
    $wikis = $data['wikis'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(__DIR__ . '/../components/head.php') ?>
</head>

<body>
    <div class="flex flex-col justify-end items-start h-[100vh]">
        <div class="flex justify-between items-center w-full md:px-8">
            <p class="border-gray-300 rounded-t-lg p-2 pb-1 text-xl">Wikis</p>
            <?php
            if (isset($msg)) {
                if ($msg == 1) {
                    echo '<div class="bg-green-500 px-2 rounded-lg top-24 w-full absolute md:w-[50%] md:static">';
                    echo '<p class="text-white text-base md:text-lg text-center">Wiki archived successfully!</p>';
                    echo '</div>';
                } elseif ($msg == 2) {
                    echo '<div class="bg-green-500 px-2 rounded-lg top-24 w-full absolute md:w-[50%] md:static">';
                    echo '<p class="text-white text-base md:text-lg text-center">Wiki restored successfully!</p>';
                    echo '</div>';
                } else {
                    echo '<div class="bg-red-500 px-2 rounded-lg top-24 absolute md:static">';
                    echo '<p class="text-white text-base md:text-lg text-center">' . $msg . '</p>';
                    echo '</div>';
                }
            }
            ?>
            <p></p>
        </div>
        <div class="border-2 border-gray-300 rounded-xl w-full h-[90vh] flex">
            <div id="wikis" class="flex flex-col justify-center items-center w-full h-full p-1 md:p-4">
                <div class="container w-full md:w-11/12 lg:w-[95%] xl:w-3/5 mx-auto px-2">
                    <div id='recipients' class="p-2 pb-8 rounded shadow-xl bg-white">
                        <?php if (!isset($wikis)) { ?>
                            <p class="w-full h-full flex items-center justify-center">No wikis found</p>
                        <?php } else { ?>
                            <table id="table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th data-priority="1">Id</th>
                                        <th data-priority="2">Name</th>
                                        <th data-priority="3">Category</th>
                                        <th data-priority="4">Author</th>
                                        <th data-priority="5">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($wikis as $wiki) { ?>
                                        <tr>
                                            <th><?= $wiki->getId() ?></th>
                                            <th><a href="<?= CONTROOT ?>wiki/<?= $wiki->getId() ?>" target="_blank"><?= $wiki->getName() ?></a></th>
                                            <th><?= $wiki->getCategory()->getName() ?></th>
                                            <th><?= $wiki->getAuthor()->getName() ?></th>
                                            <th>
                                                <div class="mx-auto flex items-center justify-evenly w-full gap-10">
                                                    <?php if ($wiki->getIsArchived()) { ?>
                                                        <form method="post">
                                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                            <input type="hidden" name="wikiId" value="<?= $wiki->getId() ?>">
                                                            <button type="submit" name="restore" class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                                </svg>

                                                                Restore
                                                            </button>
                                                        </form>
                                                    <?php } else { ?>
                                                        <form method="post">
                                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                            <input type="hidden" name="wikiId" value="<?= $wiki->getId() ?>">
                                                            <button type="submit" name="archive" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                                                </svg>

                                                                Archive
                                                            </button>
                                                        </form>
                                                    <?php } ?>
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
</body>

</html>