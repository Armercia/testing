<?php

require basePath('vendor/autoload.php');

use Respect\Validation\Validator as v;

function validatePostData($data)
{

    return v::notEmpty()->validate($data["title"]) &&
        v::notEmpty()->validate($data["description"]);
}

function createElections()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $description = $_POST['description'];
        if (validatePostData($_POST)) {
            try {
                query_create('INSERT INTO elections (title, description) VALUES (:title, :description)', [
                    'description' => $description,
                    'title' => $title
                ]);
                loadView('component/notification', ['message' => 'Data created sucessfully', 'type' => 'success']);
            } catch (Exception) {
                loadView('component/notification', ['message' => 'User data already exists', 'type' => 'error']);
            }
        } else {
            loadView('component/notification', ['message' => 'Please input valid data', 'type' => 'error']);
        }
    }
}

function registerCandidate()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $election_id = $_POST['election_id'];
        $candidate_id = $_POST['candidate_id'];

        if (v::notEmpty()->validate($election_id) &&  v::notEmpty()->validate($candidate_id)) {
            try {
                query_create('INSERT INTO election_candidates (election_id, user_id) VALUES (:election_id, :user_id)', [
                    'election_id' => $election_id,
                    'user_id' => $candidate_id
                ]);
                loadView('component/notification', ['message' => 'Data created sucessfully', 'type' => 'success']);
            } catch (Exception) {
                loadView('component/notification', ['message' => 'User data already exists', 'type' => 'error']);
            }
        } else {
            loadView('component/notification', ['message' => 'Please input valid data', 'type' => 'error']);
        }
    }
}





function voteController()
{

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $election_id  = $_POST['election_id'];
        $voter_id = $_POST['voter_id'];
        $candidate_id = $_POST['candidate_id'];

        if (
            v::notEmpty()->validate($_POST["election_id"]) &&
            v::notEmpty()->validate($_POST["voter_id"])  &&
            v::notEmpty()->validate($_POST["candidate_id"])
        ) {
            try {

                $existingVote = query_create('SELECT * FROM votes WHERE election_id = :election_id AND voter_id = :voter_id AND candidate_id = :candidate_id', [
                    'election_id' => $election_id,
                    'voter_id' => $voter_id,
                    'candidate_id' => $candidate_id
                ]);

                if ($existingVote) {
                    loadView('component/notification', ['message' => 'You have already cast your vote for this election and candidate.', 'type' => 'error']);
                    return;
                }

                $sql = "INSERT INTO votes (election_id, voter_id, candidate_id) SELECT :election_id, :voter_id, :candidate_id FROM dual
                WHERE NOT EXISTS (
                     SELECT 1
                     FROM votes
                     WHERE election_id = :election_id
                     AND voter_id = :voter_id
                    );)";
                $params = [
                    'election_id' => $election_id,
                    'voter_id' => $voter_id,
                    'candidate_id' => $candidate_id
                ];
                $electionResult = query_create($sql, $params);

                if (!$electionResult) {
                    loadView('component/notification', ['message' => 'You have already cast your vote for this election and candidate.', 'type' => 'error']);
                    return;
                }
                _print($electionResult);

                loadView('component/notification', ['message' => 'Data created sucessfully', 'type' => 'success']);
                // header("location: dashboard");
                

                return;
            } catch (Exception) {
                loadView('component/notification', ['message' => 'There was a database error', 'type' => 'error']);

                // header("location: dashboard");
            }
        } else {
            loadView('component/notification', ['message' => 'Please input valid data', 'type' => 'error']);
            // header("location: dashboard"); 
        }
    }
}




function getCandidatesByelections($electionsId)
{

    $sql = 'SELECT  u.user_id, u.username, u.email, u.user_img_url,   e.election_id,  e.title   FROM 
            users u   JOIN elections e ON u.user_id = e.candidate_id
            WHERE  e.election_id = :election_id';

    $candidates =  query_create($sql, ['election_id' => $electionsId]);

    return $candidates;
}



function showUserVotes($user_id)
{
    // Fetch the votes of the user
    try {
        $votes = getUserVotes($user_id);
        if ($votes) {
            echo "<h2>Votes for User ID: $user_id</h2>";
            echo "<ul>";
            foreach ($votes as $vote) {
                echo "<li>Election ID: {$vote['election_id']}, Candidate ID: {$vote['candidate_id']}, Vote Date: {$vote['vote_date']}</li>";
            }
            echo "</ul>";
        } else {
            echo "No votes found for User ID: $user_id";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


function getUserVotes($user_id)
{
    $query = "
        SELECT election_id, candidate_id, vote_date
        FROM votes
        WHERE voter_id = :user_id and 
    ";

    return query_create($query, ['user_id' => $user_id]);
}
