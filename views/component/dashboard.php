<!-- your content goes here ... -->

<?php

$election_id = $_GET["election_id"] ?? 1;
$users = query('SELECT * From users', []);

$election = query('SELECT * From elections', []);
$selected_election = query('SELECT * From elections where election_id = :election_id', ['election_id' => $election_id ]);


$query = "
  SELECT DISTINCT
            u.user_id,
            u.username,
            u.email,
            u.user_img_url,
            u.user_type,
            e.election_id,
            e.title AS election_title,
            e.description AS election_description
        FROM 
            users u
        JOIN 
            election_candidates ec ON u.user_id = ec.user_id
        JOIN 
            elections e ON ec.election_id = e.election_id
        WHERE 
            u.user_type = 'candidate' AND
            e.election_id = :election_id;
";

$candidate = query_create($query, ['election_id' => $election_id]);

$sqlGetVoter = "SELECT candidate_id, COUNT(*) as total_votes FROM votes  WHERE candidate_id = :candidate_id  AND 
            election_id = :election_id   GROUP BY candidate_id  ";


?>



<div class="flex gap-4 mb-3">
    <?php foreach ($election['data'] as $value) : ?>
        <a class="group relative block rounded-xl" href="?<?php echo 'election_id=' . $value['election_id']  ?>">
            <div class=" flex justify-center">
                <div class="border border-gray-200 py-2 px-3 rounded-full ">
                    <div class="flex items-center gap-x-3">
                        <span class="text-sm text-gray-500 "> <?php echo $value['title'] ?></span>

                    </div>
                </div>
            </div>
        </a>
    <?php endforeach ?>
</div>



<div class="max-w-5xl mx-auto px-4 xl:px-0 ">
    <h5 class="font-semibold  text-5xl md:text-3xl">
        <span class="text-blue-400">Election:</span> <?php
      
        echo $selected_election['data'][0]['title']    ?>
    </h5>
    <div class="max-w-4xl">
        <p class="mt- text-neutral-400 text-lg">
            <?php echo $selected_election['data'][0]['description']  ?>
        </p>
    </div>

</div>

<br>

<div class="max-w-2xl mx-auto text-center ">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight ">Candidates</h2>
        <!-- <p class="mt-1 text-gray-600">Creative people</p> -->
    </div>



<!-- loadComponent('statistic', ['users' => $users ]) -->



<!-- <p class="my-4 text-sm">Select by elections</p>

<div class="flax">
    <a href="" class="px-2 py-1 border-2 border-blue-800 text-blue-800 rounded-lg text-sm mr-2">
        Oredo
    </a>
</div> -->
<br>

<!-- Timeline -->
<div>
    <!-- Heading -->
    <div class="ps-2 my-2 first:mt-0">
        <h3 class="text-xs font-medium uppercase text-gray-500 ">
            <!-- Oredo elections <span class="by"> {total votes 1000} </span> <span> location </span> -->
        </h3>
    </div>
    <!-- End Heading -->

    <!-- Item -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8 md:gap-12">
        <!-- Icon -->


        <?php foreach ($candidate as $user) : ?>
            <?php // _print($user) 
            ?>


            <div class="text-center ">
                <img class="rounded-full size-24 mx-auto object-cover"
                 src="<?php echo $user['user_img_url']  ? $user['user_img_url'] : "data:image/jpeg;base64,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"; ?>"
                  alt="Image Description">

                <div class="sm:flex sm:flex-col sm:h-full">
                    <div>
                        <h3 class="font-medium text-gray-800 ">
                            <?php echo  $user['username'] ?>
                        </h3>
                        <p class="mt-1 text-xs uppercase text-gray-500">
                            <?php echo  $user['email'] ?>
                        </p>
                    </div>



                    

                    <div class="mt-2">
                        <div>
                            <form action="cast_vote" method="post">
                                <input type="hidden" value="<?php echo $user['election_id'] ?>" name="election_id">
                                <input type="hidden" value="<?php echo $_SESSION['user']['user_id'] ?>" name="voter_id">
                                <input type="hidden" value="<?php echo $user['user_id'] ?>" name="candidate_id">
                                <button type="submit" class="p-1 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 ">


                                    Cast Vote

                                    <span class="inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium bg-green-500 text-white">
                                        <?php
                                        $voters = query_create($sqlGetVoter, ['candidate_id' => $user['user_id'], 'election_id' => $election_id]);
                                        echo $voters ? $voters[0]['total_votes']  : 0;
                                        //  $voters[0]['total_votes'] || 0
                                        ?>
                                    </span>


                                </button>
                            </form>



                        </div>


                    </div>

                </div>
            </div>

        <?php endforeach ?>
        <!-- End Icon -->


        <!-- End Right Content -->
    </div>
    <!-- End Item -->





    <!-- End Item -->
</div>
<!-- End Timeline -->


