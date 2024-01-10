 <!-- Popup Structure -->
 <div id="popup" class="fixed w-full h-full top-0 left-0  items-center flex justify-center hidden z-50">
     <div class="bg-white w-full md:w-7/12 h-fit border-2 border-[#202257] flex flex-col justify-start items-center overflow-y-auto md:h-fit">
         <div class="bg-[#202257] w-full md:w-7/12 h-8 fixed">
             <div class="flex justify-end">
                 <span onclick="closePopup()" class="text-2xl text-white font-bold cursor-pointer mr-3">&times;</span>
             </div>
         </div>
         <form method="post" onsubmit="return validateForm()" class="flex flex-col justify-between items-center h-full w-full mt-[10vh]">
             <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
             <div class="flex flex-col justify-center items-center mb-3 w-full">
                 <div id="tagInput" class="flex flex-col w-[65%] border-2 border-[#A1A1A1] p-2 rounded-md">
                     <p class="text-xs">Tag name</p>
                     <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="tagname" type="text" name="tag" placeholder="Name" autocomplete="off">
                 </div>
                 <div id="tagnameErr" class="text-red-600 text-xs text-center md:text-left pl-3"></div>
             </div>
             <div class="flex justify-end mb-4 w-[65%]">
                 <input required type="submit" name="submit" class="cursor-pointer w-full px-8 py-2 bg-blue-500 font-semibold rounded-lg border-2 border-blue-600 text-white" value="Add tag">
             </div>
         </form>
     </div>
 </div>
 <!-- End of Popup -->
 <!-- Popup Structure -->
 <div id="popupEdit" class="fixed w-full h-full top-0 left-0  items-center flex justify-center hidden z-50">
     <div class="bg-white w-full md:w-7/12 h-fit border-2 border-[#202257] flex flex-col justify-start items-center overflow-y-auto md:h-fit">
         <div class="bg-[#202257] w-full md:w-7/12 h-8 fixed">
             <div class="flex justify-end">
                 <span onclick="closePopup()" class="text-2xl text-white font-bold cursor-pointer mr-3">&times;</span>
             </div>
         </div>
         <form method="post" onsubmit="return validateFormEdit()" class="flex flex-col justify-between items-center h-full w-full mt-[10vh]">
             <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
             <input type="hidden" id="tagId" name="tagId" value="">
             <div class="flex flex-col justify-center items-center mb-3 w-full">
                 <div id="tagInput" class="flex flex-col w-[65%] border-2 border-[#A1A1A1] p-2 rounded-md">
                     <p class="text-xs">Tag name</p>
                     <input required class="placeholder:font-light placeholder:text-xs focus:outline-none" id="tagname2" type="text" name="tag" placeholder="Name" autocomplete="off">
                 </div>
                 <div id="tagnameErr2" class="text-red-600 text-xs text-center md:text-left pl-3"></div>
             </div>
             <div class="flex justify-end mb-4 w-[65%]">
                 <input required type="submit" name="edit" class="cursor-pointer w-full px-8 py-2 bg-blue-500 font-semibold rounded-lg border-2 border-blue-600 text-white" value="Add tag">
             </div>
         </form>
     </div>
 </div>
 <!-- End of Popup -->