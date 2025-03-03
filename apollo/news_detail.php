<?php

$newsDetail = new News();
$excistingNewsArticle = $newsDetail->getArticleContent();

if ($excistingNewsArticle) {
    foreach ($excistingNewsArticle as $row) {
?>
        <header class="masthead news-detail-header" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.52), rgba(0, 0, 0, 0)), url('uploads/news/<?= $row['news_header_image']; ?>');">
            <h2><?= $row["news_title"] ?></h2>
        </header>

        <div class="container date-container" style="
    font-family: Roboto, sans-serif;
    font-size: 16px;
    letter-spacing: 1.6px;
    line-height: 24px;
    display: flex;
    align-items: center;
    gap: 79px;
    padding: 20px;
    background-color: #070b10;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    /*! max-width: 800px; */
    margin: 0 auto;">

            <div class="news-intro-date" style="

      color: #fff;
      padding: 15px;
      border-radius: 4px;
      font-weight: bold;
      font-size: 18px;
      min-width: 120px;
      text-align: center;">
                <h2 style="margin: 0;">Date posted</h2>
                <h4><?= $row['news_created']; ?></h4>
            </div>

            <div class="text-left plain-text-content">
                <p style="margin: 0;font-size: 16px;">It has been over a year since the release of v0.90 Warlords, and what a year it has been. In the span of time since that last update quite a lot has happened, all during an ongoing pandemic, and we would like to finally delve more publicly into what we have been up to! You may have already noticed the new addition to our title, it’s quite a specific number. To finally break our silence, that leap is the reason why things are taking a little longer to announce the next big update.</p>
            </div>
        </div>

        <div class="container">
            <div class="content-container">
                <div class="text-left plain-text-content">
                    <p><?= $row['news_content']; ?></p>
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
