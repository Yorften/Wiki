<!doctype html>
<html lang="en">

<head>
    <?php require_once('components/head.php') ?>
    <title>Home | Wiki</title>

</head>

<body class="overflow-x-hidden">
    <div class="flex flex-col gap-8 justify-start min-h-screen">
        <?php require_once 'components/nav.php' ?>

        <div id="content" class="flex flex-col gap-8 justify-start w-[90%] md:w-4/5 mx-auto min-h-[90vh]">
            <div class="flex flex-col justify-center items-center w-full child:text-center h-[15vh] bg-slate-200 border border-gray-300">
                <p class="text-xl">Welcome to Wiki <?= (isset($_SESSION['userName'])) ? $_SESSION['userName']  : '' ?></p>
                <p>Empowering Knowledge, One Wiki at a Time</p>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-center gap-4 w-full">
                <div class="dark:bg-white-800 dark:text-gray-100">
                    <div class="container max-w-6xl p-6 mx-auto space-y-6 sm:space-y-12">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                                <a href="<?= CONTROOT ?>wiki/wikiId" class="group max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out">
                                    <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/wiki_logo.png" alt="Wiki Image">
                                    <div class="p-4">
                                        <div class="flex items-center mb-2">
                                            <img class="w-6 h-6 rounded-full" src="<?= ROOT ?>assets/images/profile/default_profile.png" alt="user profile image">
                                            <p class="ml-2 text-sm text-gray-400">user name</p>
                                        </div>
                                        <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline">wiki title</h2>
                                        <p class="mt-2 text-black">Lorem ipsum dolor sit amet. Lorem, ipsum.</p>
                                        <span class="text-xs text-gray-700">10/01/2024</span>
                                    </div>
                                </a>
                                
                        </div>

                        <div class="flex justify-center">
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-center items-center w-full md:w-1/3 h-full border-2 border-black shadow-xl rounded-xl">
                    <a href="">category 1</a>
                    <a href="">category 2</a>
                    <a href="">category 3</a>
                    <a href="">category 4</a>
                    <a href="">category 5</a>
                    <a href="">category 6</a>
                </div>
            </div>
        </div>
        <?php require_once 'components/footer.php' ?>
    </div>

</body>

</html>