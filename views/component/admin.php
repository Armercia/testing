<?php
$user_list = query_create('SELECT * FROM users', []);
$election_id = $_GET["election_id"] ?? 1;
$election_list = query('SELECT * From elections', []);


if (isset($_GET['delete_user_id'])) {
    $user_id = $_GET['delete_user_id'];
    deleteUser($user_id);
}

if (isset($_GET['delete_election_id'])) {
    $election_id = $_GET['delete_election_id'];
    deleteElection($election_id);
}

?>


<style>
    .tab-container {
        font-family: Arial, sans-serif;
    }

    .tab-buttons {
        display: flex;
        border-bottom: 1px solid #ccc;
    }

    .tab-button {
        padding: 10px 20px;
        cursor: pointer;
        border: none;
        /* background-color: #f1f1f1; */
        transition: background-color 0.3s;
    }

    .tab-button.active {
        background-color: #fff;
        border-bottom: 2px solid #007BFF;
    }

    .tab-content {
        display: none;
        padding: 20px;
        border: 1px solid #ccc;
        border-top: none;
    }

    .tab-content.active {
        display: block;
    }
</style>



<div class="relative bg-white border shadow-sm rounded-xl bg-blue-800">
    <img class="w-full h-[100] object-cover rounded-xl" src="https://img.freepik.com/free-photo/woman-reading-monitor_23-2149370605.jpg?t=st=1721774719~exp=1721778319~hmac=c4c3134119649b20ea62d73bb9ff230c37a1cc0de9f4fba9fdb3baefa6aaf624&w=1800" alt="Card Image">
    <div class="absolute top-0 start-0 end-0 text-white">
        <div class="p-4 md:p-5">
            <h3 class="text-lg font-bold text-white">
                Admin
            </h3>
            <p class="mt-1 text-white">
                on this page you can view all users and delete them
            </p>
            <!--      <p class="mt-5 text-xs text-gray-500 dark:text-neutral-500">
        Last updated 5 mins ago
      </p> -->
        </div>
    </div>
</div>




<div class="tab-container">
    <div class="tab-buttons">
        <button class="tab-button active" data-tab="tab1">Users</button>
        <button class="tab-button" data-tab="tab2">Election</button>
    </div>
    <div class="tab-content active" id="tab1">
        <div class="flex flex-col mt-5">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border rounded-lg overflow-hidden ">
                        <table class="min-w-full divide-y divide-gray-200 0">
                            <thead class="bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase ">Name</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase ">Email</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase ">User type</th>
                                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase ">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 0">
                                <?php foreach ($user_list as $user) : ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">
                                            <?php echo $user['username'] ?>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                            <?php echo $user['email'] ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                                            <?php echo $user['user_type'] ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <a href="?delete_user_id=<?php echo $user["user_id"] ?>" type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg
                 border border-transparent text-blue-600 hover:text-blue-800
                 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none ">
                                                Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content" id="tab2">
    <div class="flex flex-col mt-5">
  <div class="-m-1.5 overflow-x-auto">
    <div class="p-1.5 min-w-full inline-block align-middle">
      <div class="border rounded-lg overflow-hidden ">
        <table class="min-w-full divide-y divide-gray-200 0">
          <thead class="bg-gray-50 ">
            <tr>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase ">Title</th>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase ">Description</th>
              <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase ">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 0">
  
            <?php foreach($election_list["data"] as $election): ?>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">
                <?php echo $election['title'] ?>
              </td>
           
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">
                <?php echo $election['description'] ?>
              </td>
          
              <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                <a href="?delete_election_id=<?php echo $election["election_id"] ?>" type="button"
                class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg
                 border border-transparent text-blue-600 hover:text-blue-800
                 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none ">
                 Delete</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
    </div>
 
</div>











<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to the clicked button and corresponding content
                this.classList.add('active');
                document.getElementById(this.dataset.tab).classList.add('active');
            });
        });
    });
</script>