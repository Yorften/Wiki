<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once(__DIR__ . '/../components/head.php') ?>
    <style>
        .dashitem:hover>* {
            color: #202257;
        }

        .dashitem.checked>* {
            color: #202257;
        }

        .dashitem.checked {
            background-color: #fff;
        }
    </style>
    <title>Dashboard | Wiki</title>
</head>

<body>
    <div class="flex h-screen">
        <!-- Fixed sidebar -->
        <div class="flex-col p-2 w-1/6 gap-4 bg-[#202257] rounded-tr-lg rounded-br-lg shadow-[rgba(0,0,15,0.1)_8px_1px_4px_0px] hidden lg:flex">
            <a href="<?= CONTROOT ?>home" class="flex items-center w-full gap-2 md:gap-0 justify-center">
                <img src="<?= ROOT ?>assets/images/wiki_logo.png" class="object-contain h-12" alt="wiki logo">
                <div class="child:text-white">
                    <p class="indent-2 font-semibold select-none">WIKI</p>
                    <p class="md:indent-2 font-semibold select-none text-xs">One Wiki at a Time</p>
                </div>
            </a>

            <div class="flex flex-col justify-evenly h-full">

                <a href="<?= CONTROOT ?>stats" target="contentFrame" class="flex items-center gap-4 child:text-lg child:font-medium child:text-white child:select-none hover:bg-white dashitem checked">
                    <i class='bx bxs-dashboard'></i>
                    <p>Dashboard</p>
                </a>

                <a href="<?= CONTROOT ?>categories" target="contentFrame" class="flex items-center gap-4 child:text-lg child:font-medium child:text-white child:select-none hover:bg-white dashitem">
                    <i class='bx bxs-category'></i>
                    <p>Categories</p>
                </a>
                <a href="<?= CONTROOT ?>tags" target="contentFrame" class="flex items-center gap-4 child:text-lg child:font-medium child:text-white child:select-none hover:bg-white dashitem">
                    <i class='bx bxs-purchase-tag'></i>
                    <p>Tags</p>
                </a>
                <a href="<?= CONTROOT ?>wikis" target="contentFrame" class="flex items-center gap-4 child:text-lg child:font-medium child:text-white child:select-none hover:bg-white dashitem">
                    <i class='bx bxl-wikipedia'></i>
                    <p>Wikis</p>
                </a>
            </div>
        </div>
        <!-- Mobile sidebar  -->
        <div class="flex-col p-2 gap-4 bg-[#202257] shadow-[rgba(0,0,15,0.1)_8px_1px_4px_0px] flex lg:hidden w-[12vw] sm:w-[10vw]">
            <a href="<?= CONTROOT ?>home" class="flex items-center w-full gap-2 md:gap-0 justify-center">
                <img src="<?= ROOT ?>assets/images/wiki_logo.png" class="object-contain h-12" alt="wiki logo">
            </a>
            <div class="flex flex-col justify-evenly h-full">
                <a href="<?= CONTROOT ?>stats" target="contentFrame" class="flex items-center justify-center gap-4 child:text-4xl child:font-medium child:text-white child:select-none hover:bg-white dashitem checked">
                    <i class='bx bxs-dashboard'></i>
                </a>

                <a href="<?= CONTROOT ?>categories" target="contentFrame" class="flex items-center justify-center gap-4 child:text-4xl child:font-medium child:text-white child:select-none hover:bg-white dashitem">
                    <i class='bx bxs-category'></i>
                </a>
                <a href="<?= CONTROOT ?>tags" target="contentFrame" class="flex items-center justify-center gap-4 child:text-4xl child:font-medium child:text-white child:select-none hover:bg-white dashitem">
                    <i class='bx bxs-purchase-tag'></i>
                </a>
                <a href="<?= CONTROOT ?>wikis" target="contentFrame" class="flex items-center justify-center gap-4 child:text-4xl child:font-medium child:text-white child:select-none hover:bg-white dashitem">
                    <i class='bx bxl-wikipedia'></i>
                </a>
            </div>
        </div>
        <!-- Content -->
        <div class="flex flex-col flex-1 px-3 py-2 gap-2">
            <div class="self-end child:text-black md:block">
                <a class=" border-r-2 border-black text-lg pr-2 mr-2"><?= $_SESSION['userName'] ?></a>
                <a href="<?= CONTROOT ?>logout" class="text-lg">Log out</a>
            </div>
            <iframe id="contentFrame" name="contentFrame" src="<?= CONTROOT ?>stats" frameborder="0" width="100%" height="100%"></iframe>
        </div>
    </div>
    <script src="<?= ROOT ?>assets/js/sidebar.js"></script>
</body>

</html>