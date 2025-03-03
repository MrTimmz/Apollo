<?php

class Votes extends Dbh
{
    //Selecteer alle members en partijen die gelinkt zijn
    public function getUser()
    {
        $sql = 'SELECT * FROM members
        INNER JOIN member_party ON members.member_id = member_party.member_member_id
        INNER JOIN parties ON member_party.party_party_id = parties.party_id
        LIMIT 999 OFFSET 1';
        $stmt = $this->connect()->query($sql);

        $membersData = [];
        while ($row = $stmt->fetch()) {
            $membersData[] = [
                'first_name' => $row["first_name"],
                'last_name' => $row["last_name"],
                'party_name' => $row["name"],
                'party_id' => $row["party_id"]
            ];
        }
        return $membersData;
    }

    public function setVoteFirst($voteLevel, $party, $userId)
    {
        try {
            $conn = $this->connect();

            //check of de gebruiker al heeft gestemd
            if ($this->hasVotedFirst($userId) && $voteLevel == 1) {
                $conn = null;
                return 'already_voted_for_first_level';
            }
            if ($this->hasVotedSecond($userId, $party) && $voteLevel == 2) {

                $conn = null;
                return 'already_voted_for_level_2';
            }

            if ($this->hasVotedThird($userId, $party) && $voteLevel == 3) {
                $conn = null;
                return 'already_voted_for_level_3';
            }


            $sqlVotes = $conn->prepare('INSERT INTO votes (`level`, `party_id`, `created_at`) VALUES (?, ?, NOW());');
            if (!$sqlVotes->execute(array($voteLevel, $party))) {
                $conn = null;
                return 'error_inserting_vote';
            }

            // Use lastInsertId to get the last inserted ID of VOTES and insert it into user_votes
            $voteId = $conn->lastInsertId();

            $sqlUserVotes = $conn->prepare('INSERT INTO user_votes (`user_id`, `vote_id`, `created_at` ) VALUES (?, ?, NOW());');
            if (!$sqlUserVotes->execute(array($userId, $voteId))) {
                $conn = null;
                return 'error_inserting_user_vote';
            }

            $conn = null;
            return true;
        } catch (Exception $e) {
            return 'exception: ' . $e->getMessage();
        }
    }

    public function hasVotedFirst($userId)
    {
        $conn = $this->connect();
        $sqlCheck = 'SELECT COUNT(*) FROM user_votes
        INNER JOIN votes ON user_votes.vote_id = votes.vote_id
        WHERE user_votes.user_id = ? AND votes.level = 1';

        $stmt = $conn->prepare($sqlCheck);
        $stmt->execute([$userId]);

        $voteCount = $stmt->fetchColumn();
        $conn = null;

        return $voteCount > 0;
    }



    public function hasVotedSecond($userId, $partyId)

    {
        $conn = $this->connect();
        $sqlPartyCheck = 'SELECT COUNT(*) FROM user_votes
                      INNER JOIN votes ON user_votes.vote_id = votes.vote_id
                      WHERE user_votes.user_id = ? AND votes.party_id = ? AND votes.level = 1';

        $stmtPartyCheck = $conn->prepare($sqlPartyCheck);
        $stmtPartyCheck->execute([$userId, $partyId]);

        $partyVoteCount = $stmtPartyCheck->fetchColumn();

        if ($partyVoteCount > 0) {
            $conn = null;
            return 'same_party';
        }

        $sqlLevelCheck = 'SELECT COUNT(*) FROM user_votes
                      INNER JOIN votes ON user_votes.vote_id = votes.vote_id
                      WHERE user_votes.user_id = ? AND votes.level = 2';

        $stmtLevelCheck = $conn->prepare($sqlLevelCheck);
        $stmtLevelCheck->execute([$userId]);

        $levelVoteCount = $stmtLevelCheck->fetchColumn();
        $conn = null;
        if ($levelVoteCount > 0) {
            return 'already_voted';
        }
        return false;
    }

    public function hasVotedThird($userId, $partyId)
    {
        $conn = $this->connect();
        $sqlPartyCheck = 'SELECT COUNT(*) FROM user_votes
                  INNER JOIN votes ON user_votes.vote_id = votes.vote_id
                  WHERE user_votes.user_id = ? AND votes.party_id = ? AND votes.level IN (1, 2)';


        $stmtPartyCheck = $conn->prepare($sqlPartyCheck);
        $stmtPartyCheck->execute([$userId, $partyId]);

        $partyVoteCount = $stmtPartyCheck->fetchColumn();

        if ($partyVoteCount > 0) {
            $conn = null;
            return 'same_party';
        }

        $sqlLevelCheck = 'SELECT COUNT(*) FROM user_votes
                      INNER JOIN votes ON user_votes.vote_id = votes.vote_id
                      WHERE user_votes.user_id = ? AND votes.level = 3';

        $stmtLevelCheck = $conn->prepare($sqlLevelCheck);
        $stmtLevelCheck->execute([$userId]);

        $levelVoteCount = $stmtLevelCheck->fetchColumn();
        $conn = null;
        if ($levelVoteCount > 0) {
            return 'already_voted';
        }
        return false;
    }

    public function getZetels()
    {
        $sqlGetZetels = 'SELECT parties.party_id, parties.name as party_name, COUNT(*) as vote_count
        FROM votes
        INNER JOIN parties ON votes.party_id = parties.party_id
        GROUP BY parties.party_id;';

        $stmt = $this->connect()->query($sqlGetZetels);

        // Maak er een array van
        $votes_Data = [];
        while ($row = $stmt->fetch()) {
            $votes_Data[$row['party_id']] = [
                'party_name' => $row['party_name'],
                'vote_count' => $row['vote_count']
            ];
        }

        $totaalZetels = 75;
        $zetelsDeelinng = [];

        foreach ($votes_Data as $partyId => $data) {
            $percentage = $data['vote_count'] / array_sum(array_column($votes_Data, 'vote_count'));
            $seats = $percentage * $totaalZetels;

            $roundedSeats = round($seats);
            if ($roundedSeats >= 5) {
                $zetelsDeelinng[$partyId] = [
                    'party_name' => $data['party_name'],
                    'zetels' => $roundedSeats
                ];
            }
        }

        return $zetelsDeelinng;
    }

    public function getEersteTellingZetels()
    {
        $sqlGetZetels = 'SELECT parties.party_id, parties.name as party_name, COUNT(*) as vote_count
        FROM votes
        INNER JOIN parties ON votes.party_id = parties.party_id
        GROUP BY parties.party_id;';

        $stmt = $this->connect()->query($sqlGetZetels);

        // Maak er een array van
        $votes_Data = [];
        while ($row = $stmt->fetch()) {
            $votes_Data[$row['party_id']] = [
                'party_name' => $row['party_name'],
                'vote_count' => $row['vote_count']
            ];
        }

        $totaalZetels = 75;
        $zetelsDeelinng = [];

        foreach ($votes_Data as $partyId => $data) {
            $percentage = $data['vote_count'] / array_sum(array_column($votes_Data, 'vote_count'));
            $seats = $percentage * $totaalZetels;

            $roundedSeats = round($seats);
            if ($roundedSeats >= 0) {
                $zetelsDeelinng[$partyId] = [
                    'party_name' => $data['party_name'],
                    'zetels' => $roundedSeats
                ];
            }
        }

        return $zetelsDeelinng;
    }


    public function getHertellingZetels()
    {
        $sqlGetZetels = 'SELECT parties.party_id, parties.name as party_name, COUNT(*) as vote_count
        FROM votes
        INNER JOIN parties ON votes.party_id = parties.party_id
        GROUP BY parties.party_id;';

        $stmt = $this->connect()->query($sqlGetZetels);

        // Maak er een array van
        $votes_Data = [];
        while ($row = $stmt->fetch()) {
            $votes_Data[$row['party_id']] = [
                'party_name' => $row['party_name'],
                'vote_count' => $row['vote_count']
            ];
        }

        $totaalZetels = 75;
        $zetelsDeelinng = [];

        foreach ($votes_Data as $partyId => $data) {
            $percentage = $data['vote_count'] / array_sum(array_column($votes_Data, 'vote_count'));
            $seats = $percentage * $totaalZetels;

            $roundedSeats = round($seats);
            if ($roundedSeats >= 3.33) {
                $zetelsDeelinng[$partyId] = [
                    'party_name' => $data['party_name'],
                    'zetels' => $roundedSeats
                ];
            }
        }

        return $zetelsDeelinng;
    }
}
