<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Edit extends Controller
{
    public function editWiki()
    {
        $tag = $this->model('TagDAO');
        $category = $this->model('CategoryDAO');
        $tags = $tag->getAllTags();
        $categories = $category->getAllCategories();
        $data = json_decode($_POST['json_data'], true);
?>
        <div class="w-full flex items-end justify-between border-b-2 p-2">
            <div class="flex flex-col w-full">
                <input type="text" id="title" class="w-full text-lg font-medium" value="<?= $data['title'] ?>">
                <div id="titleErr" class="text-red-600 text-sm font-medium pl-3 w-[95%] md:w-3/4 mx-auto"></div>
            </div>

            <button id="apply" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 shadow-lg text-sm font-medium rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Apply
            </button>
            <button id="cancel" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 shadow-lg text-sm font-medium rounded-md">
                Back
            </button>
        </div>
        <div class="flex flex-col-reverse items-center lg:flex-row lg:items-start justify-center gap-4 w-full h-full pt-2">
            <div class="p-2 text-center bg-red-500 rounded-lg text-white absolute top-28 md:top-16 hidden">
                <p id="error"></p>
            </div>
            <div class="dark:bg-white-800 dark:text-gray-100 w-full h-full">
                <div class="flex flex-col container max-w-6xl p-4 mx-auto space-y-6 sm:space-y-12 w-full h-full shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
                    <textarea name="content" id="wikicontent" cols="30" rows="50" placeholder="Article content" class="w-full p-1 mx-auto text-black font-medium"><?= $data['content'] ?></textarea>
                    <div id="contentErr" class="text-red-600 text-sm font-medium pl-3 w-[95%] md:w-3/4 mx-auto"></div>
                </div>
            </div>
            <div class="flex flex-col gap-4 w-full md:w-[35%] md:mx-auto h-full border-t-2">
                <div class="flex flex-col gap-2 w-full h-full shadow-lg p-4">
                    <p class="text-lg font-medium">Wiki image</p>
                    <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                        <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="image" type="file" name="wikiImage" autocomplete="off">
                    </div>
                    <p class="text-lg font-medium">Description</p>
                    <div class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                        <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="desc" type="text" name="desc" autocomplete="off" value="<?= $data['desc'] ?>">
                        <div id="descErr" class="text-red-600 text-sm font-medium pl-3 w-[95%] md:w-3/4 mx-auto"></div>
                    </div>
                </div>
                <div class="flex flex-col gap-4 w-full h-full shadow-lg p-4">
                    <select id="category" class="block leading-5 text-gray-700 bg-white focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-300 w-full h-[40px] font-medium">
                        <option value="" selected hidden>Select a category</option>
                        <?php if (!isset($categories)) { ?>
                            <option value="" disabled>No categories found</option>
                            <?php } else {
                            foreach ($categories as $category) { ?>
                                <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                        <?php }
                        } ?>
                    </select>
                    <select id="tagSelect" multiple>
                        <option value="" selected hidden>Select tags</option>
                        <?php if (!isset($tags)) { ?>
                            <option value="" disabled>No tags found</option>
                            <?php } else {
                            foreach ($tags as $tag) { ?>
                                <option id="tag<?= $tag->getId() ?>" value="<?= $tag->getId() ?>"><?= $tag->getName() ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>
        </div>
<?php }
}
