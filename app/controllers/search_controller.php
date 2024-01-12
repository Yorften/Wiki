<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Search extends Controller
{
    public function getwikis()
    {
        $wiki = $this->model('WikiDAO');
        $data = json_decode(file_get_contents("php://input"), true);
        $wikis = $wiki->getWikisByName($data['search']);
        if (count($wikis) >= 1) { ?>
            <p class="text-3xl font-semibold">Search results : wikis</p>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <?php foreach ($wikis as $wiki) { ?>
                    <a href="<?= CONTROOT ?>wiki/<?= $wiki->getId() ?>" class="group w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out">
                        <?php if ($wiki->getImage() == null) { ?>
                            <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/wiki_logo.png" alt="Wiki Image">
                        <?php } else { ?>
                            <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/<?= $wiki->getImage() ?>" alt="Wiki Image">
                        <?php } ?>
                        <div class="p-4">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <img class="w-6 h-6 rounded-full" src="<?= ROOT ?>assets/images/profile/default_profile.png" alt="user profile image">
                                    <p class="ml-2 text-sm text-gray-400"><?= $wiki->getAuthor()->getName() ?></p>
                                </div>
                                <p class="text-sm p-1 rounded-xl border border-gray-500 text-gray-500"><?= $wiki->getCategory()->getName() ?></p>
                            </div>
                            <?php if (strlen($wiki->getName()) > 14) { ?>
                                <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline"><?= substr($wiki->getName(), 0, 12) ?>...</h2>
                            <?php } else { ?>
                                <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline"><?= $wiki->getName() ?></h2>
                            <?php } ?>
                            <?php if (strlen($wiki->getDesc()) > 35) { ?>
                                <p class="mt-2 text-black"><?= substr($wiki->getDesc(), 0, 35) ?>...</p>
                            <?php } else { ?>
                                <p class="mt-2 text-black"><?= $wiki->getDesc() ?></p>
                            <?php } ?>
                            <span class="text-xs text-gray-700"><?= $wiki->getDate() ?></span>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php  } else { ?>
            <p class="text-3xl font-semibold">Search results : wikis</p>
            <p class="text-xl font-semibold">No wikis found</p>
        <?php   }
    }

    public function getcategories()
    {
        $wiki = $this->model('WikiDAO');
        $data = json_decode(file_get_contents("php://input"), true);
        $wikis = $wiki->searchWikisByCategory($data['search']);
        if (count($wikis) >= 1) { ?>
            <p class="text-3xl font-semibold">Search results : categories</p>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <?php foreach ($wikis as $wiki) { ?>
                    <a href="<?= CONTROOT ?>wiki/<?= $wiki->getId() ?>" class="group w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out">
                        <?php if ($wiki->getImage() == null) { ?>
                            <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/wiki_logo.png" alt="Wiki Image">
                        <?php } else { ?>
                            <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/<?= $wiki->getImage() ?>" alt="Wiki Image">
                        <?php } ?>
                        <div class="p-4">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <img class="w-6 h-6 rounded-full" src="<?= ROOT ?>assets/images/profile/default_profile.png" alt="user profile image">
                                    <p class="ml-2 text-sm text-gray-400"><?= $wiki->getAuthor()->getName() ?></p>
                                </div>
                                <p class="text-sm p-1 rounded-xl border border-gray-500 text-gray-500"><?= $wiki->getCategory()->getName() ?></p>
                            </div>
                            <?php if (strlen($wiki->getName()) > 14) { ?>
                                <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline"><?= substr($wiki->getName(), 0, 12) ?>...</h2>
                            <?php } else { ?>
                                <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline"><?= $wiki->getName() ?></h2>
                            <?php } ?>
                            <?php if (strlen($wiki->getDesc()) > 35) { ?>
                                <p class="mt-2 text-black"><?= substr($wiki->getDesc(), 0, 35) ?>...</p>
                            <?php } else { ?>
                                <p class="mt-2 text-black"><?= $wiki->getDesc() ?></p>
                            <?php } ?>
                            <span class="text-xs text-gray-700"><?= $wiki->getDate() ?></span>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php  } else { ?>
            <p class="text-3xl font-semibold">Search results : categories</p>
            <p class="text-xl font-semibold">No wikis found</p>
        <?php   }
    }

    public function gettags()
    {
        $wiki = $this->model('WikiTagDAO');
        $data = json_decode(file_get_contents("php://input"), true);
        $wikis = $wiki->getWikisByTag($data['search']);
        if (count($wikis) >= 1) { ?>
            <p class="text-3xl font-semibold">Search results : tags</p>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <?php foreach ($wikis as $wiki) { ?>
                    <a href="<?= CONTROOT ?>wiki/<?= $wiki->getId() ?>" class="group w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out">
                        <?php if ($wiki->getImage() == null) { ?>
                            <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/wiki_logo.png" alt="Wiki Image">
                        <?php } else { ?>
                            <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/<?= $wiki->getImage() ?>" alt="Wiki Image">
                        <?php } ?>
                        <div class="p-4">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <img class="w-6 h-6 rounded-full" src="<?= ROOT ?>assets/images/profile/default_profile.png" alt="user profile image">
                                    <p class="ml-2 text-sm text-gray-400"><?= $wiki->getAuthor()->getName() ?></p>
                                </div>
                                <p class="text-sm p-1 rounded-xl border border-gray-500 text-gray-500"><?= $wiki->getCategory()->getName() ?></p>
                            </div>
                            <?php if (strlen($wiki->getName()) > 14) { ?>
                                <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline"><?= substr($wiki->getName(), 0, 12) ?>...</h2>
                            <?php } else { ?>
                                <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline"><?= $wiki->getName() ?></h2>
                            <?php } ?>
                            <?php if (strlen($wiki->getDesc()) > 35) { ?>
                                <p class="mt-2 text-black"><?= substr($wiki->getDesc(), 0, 35) ?>...</p>
                            <?php } else { ?>
                                <p class="mt-2 text-black"><?= $wiki->getDesc() ?></p>
                            <?php } ?>
                            <span class="text-xs text-gray-700"><?= $wiki->getDate() ?></span>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php  } else { ?>
            <p class="text-3xl font-semibold">Search results : tags</p>
            <p class="text-xl font-semibold">No wikis found</p>
<?php   }
    }
}
