<?php updateUser() ?>

<!-- Card Section -->
<style>
  /* Hide the actual file input */
  #fileInput {
    display: none;
  }
</style>

<div class=""><!-- Card -->
  <div class="bg-white">
    <div class="mb-8">
      <h2 class="text-xl font-bold text-gray-800">Profile</h2>
      <p class="text-sm text-gray-600">Manage your name, password, and account settings.</p>
    </div>

    <form method="POST" enctype="multipart/form-data">
      <!-- Grid -->
      <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
        <div class="sm:col-span-3">
          <label class="inline-block text-sm text-gray-800 mt-2.5">Profile photo</label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <div class="flex items-center gap-5">
            <img class="inline-block size-16 rounded-full ring-2 ring-white" src="<?php echo $_SESSION['user']['user_img_url'] ?>" id="priviewImg"
              alt="Image Description">
            <div class="flex gap-x-2">
              <div>
                <input type="file" value="<?php echo $_SESSION['user']['user_img_url']  ?>" name="file" id="fileInput">
                <button id="openFileInput" type="button"
                  class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                  <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="17 8 12 3 7 8" />
                    <line x1="12" x2="12" y1="3" y2="15" />
                  </svg>
                  Upload photo
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
          <label for="af-account-full-name" class="inline-block text-sm text-gray-800 mt-2.5">Full name</label>
          <div class="hs-tooltip inline-block">
            <button type="button" class="hs-tooltip-toggle ms-1">
              <svg class="inline-block size-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                  d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
              </svg>
            </button>
            <span
              class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible w-40 text-center z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm"
              role="tooltip">
              Displayed on public forums, such as Preline
            </span>
          </div>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <input id="af-account-full-name" name="username" value="<?php echo $_SESSION['user']['username'] ?>" type="text"
            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
            placeholder="">
        </div>
        <!-- End Col -->

        <div class="sm:col-span-3">
          <label for="af-account-email" class="inline-block text-sm text-gray-800 mt-2.5">Email</label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <input id="af-account-email" name="email" value="<?php echo $_SESSION['user']['email'] ?>" type="email"
            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
            placeholder="maria@site.com">
        </div>
        <!-- End Col 

        <div class="sm:col-span-3">
          <label for="af-account-gender-checkbox" class="inline-block text-sm text-gray-800 mt-2.5">Gender</label>
        </div>


        <div class="sm:col-span-9">
          <div class="sm:flex">
            <label for="af-account-gender-checkbox"
              class="flex py-2 px-3 w-full border border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
              <input type="radio" value="male" name="gender"
                class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                id="af-account-gender-checkbox" checked>
              <span class="text-sm text-gray-500 ms-3">Male</span>
            </label>

            <label for="af-account-gender-checkbox-female"
              class="flex py-2 px-3 w-full border border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
              <input type="radio" name="gender"
                class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                id="af-account-gender-checkbox-female">
              <span class="text-sm text-gray-500 ms-3">Female</span>
            </label>
          </div>
        </div>
 End Col -->

        <div class="sm:col-span-3">
          <label for="af-account-bio" class="inline-block text-sm text-gray-800 mt-2.5">BIO</label>
        </div>
        <!-- End Col -->

        <div class="sm:col-span-9">
          <textarea id="af-account-bio" name="bio"
            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
            rows="6" placeholder="Type your message..."><?php echo $_SESSION['user']['bio'] ?></textarea>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Grid -->

      <div class="mt-5 flex justify-end gap-x-2">
        <button type="submit"
          class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
          Save changes
        </button>
      </div>
    </form>
  </div>
  <!-- End Card -->
</div>
<!-- End Card Section -->

<script>
  document.getElementById('openFileInput').addEventListener('click', function () {
    document.getElementById('fileInput').click();
    document.getElementById('fileInput').onchange = function () {
      var reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById('priviewImg').src = e.target.result;
      }
      reader.readAsDataURL(document.getElementById('fileInput').files[0]);
    }
  });
</script>
