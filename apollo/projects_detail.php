<?php

$projectDetail = new Projects();
$excistingProjectDetail = $projectDetail->getProjectContent();

if ($excistingProjectDetail) {
    foreach ($excistingProjectDetail as $row) {
?>
        <header class="masthead news-detail-header" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.52), rgba(0, 0, 0, 0)), url('uploads/projects/image/<?= $row['project_image']; ?>');">
            <h2><?= $row["project_name"] ?></h2>
        </header>

        <div class="container" style="display:flex; position:relative;">
            <div class="content-container-left">
                <div class="text-left plain-text-content">
                    <div style="height:250px; background-size:contain; background-position: center; background-image: url('https://static.wikia.nocookie.net/armedassault/images/9/90/Reforger-coverart.jpg');"></div>
                    <h5>Developer: Bohemia Interactive</h5>
                    <h5>Publisher: Bohemia Interactive</h5>
                    <hr>
                    <h5>Game: ARMA REFORGER</h5>
                    <h6>Genre: Action, Simulation, Strategy</h6>
                    <h6>Franchise: Arma Franchise</h6>
                    <h6>Players: 1 - 64</h6>
                    <hr>
                    <h6>Release Date: 16 Nov, 2023</h6>
                    <h6>Early Access Release Date: 17 May, 2022</h6>
                </div>

                <div class="spacer lrg"></div>
                <div class="spacer lrg"></div>

                <div class="text-left plain-text-content" style="position: absolute; bottom:0; width:26%;">
                    <h2>Legal Notice:</h2>
                    <p>[PROJECTNAME] is created under the license of [INSERT COMPANYNAME] "Game Content Rules" and is using concepts from [INSERT UNIVERSE].<br>
                        [PROJECTNAME] is a non profit project for [universe] Fans.</p>
                </div>
            </div>

            <div class="content-container-right">
                <div class="text-left plain-text-content">
                    <p><?= $row['project_desc']; ?></p>

                </div>
            </div>
        </div>

        <script>
            let animationContainer = document.querySelector('.animated-title');
            let textData = animationContainer.getAttribute('aria-label');

            function splitWords() {
                let splitedText = textData.split(' ');

                splitedText.join('& &').split('&').forEach(function(e) {
                    let span = document.createElement('span');
                    span.classList.add('animated-word');
                    span.setAttribute('data-text', e);
                    animationContainer.appendChild(span);
                });
                splitLetters();
            }
            splitWords()


            function splitLetters() {
                let animatedWords = document.querySelectorAll('.animated-word');
                animatedWords.forEach(function(e, i) {
                    e.getAttribute('data-text').split('').forEach(function(f, j) {
                        f = f == ' ' ? '&#32;' : f;
                        let span = document.createElement('span');
                        span.classList.add('animated-element');
                        span.setAttribute('aria-hidden', 'true');
                        span.innerHTML = f;
                        e.appendChild(span);
                    });
                    animate(e, i);
                })
            }

            function animate(e, i) {
                let wordCount = e.getAttribute('data-text').length;
                e.style.opacity = 1;
                e.classList.add('animate');
            }

            // Replay Button - For Demo purpose only
            function replay() {
                let animatedWords = document.querySelectorAll('.animated-word');
                animatedWords.forEach(function(e, i) {
                    e.classList.remove('animate');
                    e.style.opacity = 0;
                    setTimeout(() => {
                        animate(e, i);
                    }, 500);
                })
            }
        </script>
<?php
    }
}
