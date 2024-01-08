<!doctype html>
<html lang="en">

<head>
    <?php require_once('components/head.php') ?>
    <title>Wiki | Home</title>

</head>

<body class="overflow-x-hidden">
    <div class="flex flex-col gap-8 justify-start min-h-screen">
        <?php require_once 'components/nav.php' ?>

        <div id="content" class="flex flex-col gap-8 justify-start w-[90%] md:w-4/5 mx-auto min-h-[90vh]">
            <div class="flex flex-col justify-center items-center w-full child:text-center h-[15vh] bg-slate-200 border border-gray-300">
                <p class="text-xl">Welcome to Wiki</p>
                <p>Empowering Knowledge, One Wiki at a Time</p>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-center gap-4 w-full">
                <div class="flex flex-col justify-center items-center w-full md:w-2/3 h-full border-2 border-black shadow-xl rounded-xl">
                    <div class="flex items-center justify-center gap-2">
                        <img src="<?= ROOT ?>assets/images/profile/default_profile.png" class="rounded-xl object-contain h-[25vw] md:h-[30vh]" alt="">
                        <div class="flex flex-col justify-between items-center h-full px-2">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid molestiae esse cumque officia deleniti error, ex temporibus quo ducimus sed! Vel explicabo aut reiciendis culpa quas a molestiae distinctio optio!</p>
                            <p class="self-end">By Author Name</p>
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
    </div>
</body>

</html>