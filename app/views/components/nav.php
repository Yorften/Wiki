<div class="flex flex-col items-center justify-start w-full gap-4 h-[15vh] md:gap-0 md:h-[10vh] pt-2">
    <div class="flex flex-wrap items-center justify-around w-full">
        <a href="<?= CONTROOT ?>home" class="flex items-center gap-2 md:gap-0 justify-center md:order-first">
            <img src="<?= ROOT ?>assets/images/wiki_logo.png" class="object-contain h-12" alt="wiki logo">
            <div>
                <p class="indent-2 font-semibold select-none">WIKI</p>
                <p class="md:indent-2 font-semibold select-none text-xs">One Wiki at a Time</p>
            </div>
        </a>
        <div class="md:flex relative items-center w-3/5 md:w-2/5 border-t-2 shadow-xl h-12 rounded-lg focus-within:shadow-lg bg-white overflow-hidden order-last md:order-none">
            <div class="grid place-items-center h-full w-12 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input class="peer h-full w-full outline-none text-sm text-gray-700 pr-2" type="text" id="search" placeholder="Search something.." />
        </div>

        <?php if (isset($_SESSION['userId'])) {
            if ($_SESSION['userRole'] == 'admin') { ?>
                <div class="flex items-center gap-6 md:order-last">
                    <div class="group relative hidden md:inline-block">
                            <div class="rounded-full bg-gray-300 h-10 leading-10 cursor-pointer">
                                <a href="<?= CONTROOT ?>dashboard">
                                    <img class="rounded-full float-left h-full object-cover" src="<?= ROOT ?>assets/images/profile/default_profile.png"> <span class="px-2"><?= $_SESSION['userName'] ?></span>
                                </a>
                            </div>
                            <div class="opacity-0 w-28 bg-black text-white text-center text-xs rounded-lg py-2 absolute z-10 group-hover:opacity-100 top-full right-[10%] px-3 pointer-events-none">
                                Dashboard
                                <svg class="absolute text-black h-2 w-full left-0 bottom-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve">
                                    <polygon class="fill-current" points="0,255 127.5,127.5 255,255" />
                                </svg>
                            </div>
                        </div>
                    <a href="<?= CONTROOT ?>logout" class="underline">Log out</a>
                </div>
            <?php } elseif ($_SESSION['userRole'] == 'author') { ?>
                <div class="flex items-center gap-6 md:order-last">
                    <div class="rounded-full bg-gray-300 h-10 leading-10 cursor-pointer">
                        <img class="rounded-full float-left h-full object-cover" src="<?= ROOT ?>assets/images/profile/default_profile.png"> <span class="px-2"><?= $_SESSION['userName'] ?></span>
                    </div>
                    <a href="<?= CONTROOT ?>logout" class="underline">Log out</a>
                </div>
            <?php } else { ?>
                <div class="items-center justify-center flex">
                    <a href="<?= CONTROOT ?>login" class=" border-r-2 border-black text-lg pr-2 mr-2">Log in</a>
                    <a href="<?= CONTROOT ?>signup" class="text-lg">Sign up</a>
                </div>
        <?php }
        } ?>
    </div>
</div>