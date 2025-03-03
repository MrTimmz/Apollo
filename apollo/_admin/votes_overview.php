<?php include "header.php"; ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    .carousel-control.left {
        background-image: none;
        padding-left: 8px;
        padding-right: 8px;
    }

    .carousel-control.right {
        background-image: none;
        padding-left: 8px;
        padding-right: 8px;
    }

    .carousel {
        padding-left: 35px;
        padding-right: 35px;
        margin-bottom: 30px;
    }

    .carousel-control {
        color: #73a9d9;
        width: auto;
        opacity: 1;

    }

    .carousel-control:focus,
    .carousel-control:hover {
        color: #23527c;
    }

    .carousel-indicators {
        bottom: -40px;
    }

    .carousel-indicators li {
        border: 1px solid #73a9d9;
        text-indent: initial;
        width: auto;
        height: auto;
        border-radius: 0px;
        padding: 5px 40px;
    }

    .carousel-indicators .active {
        border: 1px solid #73a9d9;
        background-color: #d7e6f4;
        text-indent: initial;
        width: auto;
        height: auto;
        border-radius: 0px;
        padding: 5px 40px;
    }

    .carousel-inner .title {
        text-align: center;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Partij en Partij leden overzicht</h6>
            <?php echo '<td>
                <a href="classes/votes.php?party_id=1&level=99" class="btn btn-success btn-icon-split">
                    <span class="text">BLANCO Stem uitbrengen</span>
                </a>'; ?>
        </div>

        <div class="card-body">

            <div class="container" style="padding-top:10px">
                <div class="panel panel-primary">
                    <div class="panel-heading">

                    </div>
                    <div id="body" class="panel-body">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators"></ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <h4 class="title">Zetels verdeling Tweedekamer</h4>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Partij</th>
                                                <th>Aantal Zetels</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $userZetels = new Votes();
                                            $zetelsDeelinng = $userZetels->getZetels();

                                            foreach ($zetelsDeelinng as $party) {
                                                $roundedSeats = round($party['zetels']);
                                                if ($roundedSeats >= 5) {
                                                    echo "<tr>";
                                                    echo "<td>" . $party['party_name'] . "</td>";
                                                    echo "<td>" . $party['zetels'] . "</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="item">
                                    <h4 class="title">
                                        Eerste Telling Resultaat
                                    </h4>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Partij</th>
                                                <th>Aantal Zetels</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $userZetels = new Votes();
                                            $zetelsDeelinng = $userZetels->getEersteTellingZetels();

                                            foreach ($zetelsDeelinng as $party) {
                                                $roundedSeats = round($party['zetels']);
                                                if ($roundedSeats >= 0) {
                                                    echo "<tr>";
                                                    echo "<td>" . $party['party_name'] . "</td>";
                                                    echo "<td>" . $party['zetels'] . "</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="item">
                                    <h4 class="title">Hertelling Telling Tweedekamer</h4>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Partij</th>
                                                <th>Zetels</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $userZetels = new Votes();
                                            $zetelsDeelinng = $userZetels->getHertellingZetels();

                                            foreach ($zetelsDeelinng as $party) {
                                                $roundedSeats = round($party['zetels']);
                                                if ($roundedSeats >= 0) {
                                                    echo "<tr>";
                                                    echo "<td>" . $party['party_name'] . "</td>";
                                                    echo "<td>" . $party['zetels'] . "</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>
                    </div>
                </div>
            </div>




            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Voornaam</th>
                            <th>Achternaam</th>
                            <th>Partij</th>

                            <th>Stem Keuze 1</th>
                            <th>Stem Keuze 2</th>
                            <th>Stem Keuze 3</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Voornaam</th>
                            <th>Achternaam</th>
                            <th>Partij</th>
                            <th>Stem Keuze 1</th>
                            <th>Stem Keuze 2</th>
                            <th>Stem Keuze 3</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $userObj = new Votes();
                        $membersData = $userObj->getUser();
                        //gebruiker de userBSM session om te kijken of de user_id die we nu gebruiken al bestaat in de record, zo ja echo alreadyvoted anders stemmen.
                        $userBsn = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
                        foreach ($membersData as $memberData) {
                            echo '<tr>';
                            echo '<td>' . $memberData["first_name"] . '</td>';
                            echo '<td>' . $memberData["last_name"] . '</td>';
                            echo '<td>' . $memberData["party_name"] . '</td>';
                            echo '<td>';
                            if ($userObj->hasVotedFirst($userBsn)) {
                                echo '<div class="btn-group mr-2" role="group" aria-label="Eerste Keuze Groep">
                                        <button class="btn btn-secondary btn-icon-split" disabled>
                                            <span class="text">Stem uitgebracht</span>
                                        </button>';
                            } else {
                                echo '<a href="classes/votes.php?party_id=' . $memberData["party_id"] . '&level=1" class="btn btn-success btn-icon-split">
                                        <span class="text">Stem uitbrengen</span>
                                    </a>';
                            }
                            echo '</td>';

                            echo '<td>';
                            $voteStatus = $userObj->hasVotedSecond($userBsn, $memberData["party_id"], 2);

                            if ($voteStatus === 'same_party') {
                                echo '<div class="btn-group mr-2" role="group" aria-label="Eerste Keuze Groep">
                                    <button class="btn btn-danger btn-icon-split" disabled>
                                        <span class="text">Kan niet op de zelfde partij stemmen.</span>
                                    </button>';
                            } elseif ($voteStatus === 'already_voted') {
                                echo '<div class="btn-group mr-2" role="group" aria-label="Eerste Keuze Groep">
                                    <button class="btn btn-secondary btn-icon-split" disabled>
                                        <span class="text">Stem uitgebracht</span>
                                    </button>';
                            } else {
                                echo '<a href="classes/votes.php?party_id=' . $memberData["party_id"] . '&level=2" class="btn btn-success btn-icon-split">
                                    <span class="text">Stem uitbrengen</span>
                                </a>';
                            }
                            echo '</td>';

                            echo '<td>';
                            $voteStatus = $userObj->hasVotedThird($userBsn, $memberData["party_id"], 3);

                            if ($voteStatus === 'same_party') {
                                echo '<div class="btn-group mr-2" role="group" aria-label="Eerste Keuze Groep">
                                    <button class="btn btn-danger btn-icon-split" disabled>
                                        <span class="text">Kan niet op de zelfde partij stemmen.</span>
                                    </button>';
                            } elseif ($voteStatus === 'already_voted') {
                                echo '<div class="btn-group mr-2" role="group" aria-label="Eerste Keuze Groep">
                                    <button class="btn btn-secondary btn-icon-split" disabled>
                                        <span class="text">Stem uitgebracht</span>
                                    </button>';
                            } else {
                                echo '<a href="classes/votes.php?party_id=' . $memberData["party_id"] . '&level=3" class="btn btn-success btn-icon-split">
                                    <span class="text">Stem uitbrengen</span>
                                </a>';
                            }
                            echo '</td>';

                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?php include "footer.php"; ?>