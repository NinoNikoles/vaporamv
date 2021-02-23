<footer class="footer-main">
    <div class="row">
        <div class="column small-12">
            <ul>
                <li class="company">
                    <a href="./" title="Home">
                        VAPORAMV
                    </a>
                </li>
                <li>
                    <ul class="footer-navigation">
                        <li>
                            <a href="/songs.php" title="Songs">
                                Songs
                            </a>
                        </li>
                        <li>
                            <a href="/alben.php" title="Alben">
                                Alben
                            </a>
                        </li>
                        <!--                        <li>-->
                        <!--                            <a href="/impressum.php">-->
                        <!--                                Impressum-->
                        <!--                            </a>-->
                        <!--                        </li>-->
                    </ul>
                </li>
                <li class="lang-change">
                    <label class="lang-change-label">Sprache: Deutsch</label>
                    <!--                    <select class="lang-change-select">-->
                    <!--                        <option data-lang="de" value="de">Deutsch</option>-->
                    <!--                        <option data-lang="en" value="en">English</option>-->
                    <!--                    </select>-->
                </li>
            </ul>
        </div>
    </div>
</footer>

<script src="assets/js/vendor/jquery.js"></script>
<script src="assets/js/vendor/what-input.js"></script>
<script src="assets/js/vendor/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>

<script src="assets/js/particles.js"></script>
<script src="assets/js/app.js"></script>

<?php if( $video == 1 ) { ?>
    <script>
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        //Holds a reference to the YouTube player
        var player;

        //this function is called by the API
        function onYouTubeIframeAPIReady() {
            //creates the player object
            player = new YT.Player('player');

            //subscribe to events
            player.addEventListener("onReady",       "onYouTubePlayerReady");
            player.addEventListener("onStateChange", "onYouTubePlayerStateChange");
        }

        function onYouTubePlayerReady(event) {
            event.target.playVideo();
        }

        function onYouTubePlayerStateChange(event) {
            switch (event.data) {
                case YT.PlayerState.ENDED:
                    if($('#link-1').length > 0) {
                        var href = $('#link-1').attr('href');
                        window.location.href = href;
                    }
                    break;
            }
        }
    </script>
<?php } ?>

</div>
</body>
</html>