<?php
if (!empty($data['msg'])) {
    $msg = $data['msg'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once('components/head.php') ?>
    <title>Login | Wiki</title>

</head>

<body class="overflow-x-hidden">
    <div class="flex flex-col gap-8 justify-start min-h-screen">
        <?php require_once 'components/nav.php' ?>

        <div id="content" class="flex justify-center my-12">
            <div class="flex flex-col justify-center w-[85%] bg-white rounded-lg shadow-xl md:w-1/2">
                <form onsubmit="return validateLogin()" action="<?= CONTROOT ?>login" class="w-4/5 mx-auto" method="post">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <div class="flex flex-col mt-8">
                        <div class="capitalize mb-5 font-bold md:font-semibold text-xl">
                            <p>Log in</p>
                        </div>
                        <?php
                        if (isset($msg)) {
                            foreach ($msg as $error) {
                                echo '<div class="bg-red-500 mb-3 rounded-lg">';
                                echo '<p class="text-white text-lg text-center">' . $error . '</p>';
                                echo '</div>';
                            }
                        }

                        ?>
                        <!-- Start of input name -->
                        <div class="flex flex-col mb-3">
                            <div id="emailInput" class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                                <p class="text-xs">Email</p>
                                <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="email" type="text" name="email" placeholder="example@exm.com" autocomplete="on">
                            </div>
                            <div id="emailErr" class="text-red-600 text-xs pl-3"></div>
                        </div>
                        <!-- End of input name -->
                        <div class="flex flex-col mb-3">
                            <div id="passwordInput" class="flex flex-col border-2 border-[#A1A1A1] p-2 rounded-md">
                                <p class="text-xs">Password</p>
                                <input class="placeholder:font-light placeholder:text-xs focus:outline-none" id="password" type="password" name="password" placeholder="***************">
                            </div>
                            <div id="passwordErr" class="text-red-600 text-xs pl-3"></div>
                        </div>


                    </div>
                    <div class="flex justify-start mb-8">
                        <a href="<?= CONTROOT ?>signup" class="text-sm text-gray-800 underline">Don't have an account yet? Sign Up</a>
                    </div>
                    <div class="flex justify-center mb-4">
                        <input type="submit" name="login" class="cursor-pointer w-full text-white px-8 py-2 bg-[#3366cc] font-semibold rounded-lg border-2 border-[#284a8f]" value="Log in">
                    </div>
                </form>

            </div>
        </div>
        <?php require_once 'components/footer.php' ?>
        <script src="<?= ROOT ?>assets/js/regex_login.js"></script>
    </div>
</body>

</html>