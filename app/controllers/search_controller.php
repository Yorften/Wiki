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
                    <a href="<?= CONTROOT ?>wiki/wikiid" class="group w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out">
                        <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/wiki_logo.png" alt="Wiki Image">
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <img class="w-6 h-6 rounded-full" src="<?= ROOT ?>assets/images/profile/default_profile.png" alt="user profile image">
                                <p class="ml-2 text-sm text-gray-400">author</p>
                            </div>
                            <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline">wiki name
                            </h2>
                            <p class="mt-2 text-black">wiki desc</p>
                            <span class="text-xs text-gray-700">date</span>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php  } else { ?>
            <p class="text-3xl font-semibold">No wikis found</p>
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
                    <a href="<?= CONTROOT ?>wiki/wikiid" class="group w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out">
                        <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/wiki_logo.png" alt="Wiki Image">
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <img class="w-6 h-6 rounded-full" src="<?= ROOT ?>assets/images/profile/default_profile.png" alt="user profile image">
                                <p class="ml-2 text-sm text-gray-400">author</p>
                            </div>
                            <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline">wiki name
                            </h2>
                            <p class="mt-2 text-black">wiki desc</p>
                            <span class="text-xs text-gray-700">date</span>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php  } else { ?>
            <p class="text-3xl font-semibold">No wikis found</p>
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
                    <a href="<?= CONTROOT ?>wiki/wikiid" class="group w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out">
                        <img class="object-cover w-full h-44 dark:bg-gray-500" src="<?= ROOT ?>assets/images/wikis/wiki_logo.png" alt="Wiki Image">
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <img class="w-6 h-6 rounded-full" src="<?= ROOT ?>assets/images/profile/default_profile.png" alt="user profile image">
                                <p class="ml-2 text-sm text-gray-400">author</p>
                            </div>
                            <h2 class="text-2xl font-semibold text-black group-hover:underline group-focus:underline">wiki name
                            </h2>
                            <p class="mt-2 text-black">wiki desc</p>
                            <span class="text-xs text-gray-700">date</span>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php  } else { ?>
            <p class="text-3xl font-semibold">No wikis found</p>
<?php   }
    }
}
