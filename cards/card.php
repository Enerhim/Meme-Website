<div class="card mb-3 w-50" style="width: 18rem;">
    <img src=<?php echo $link ?> class="card-img-top" alt="Error loading meme">
    <div class="card-body">
        <h5 class="card-title"><?php echo $title ?></h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Posted by
            <?php
            if ($author != $_SESSION["name"]) {
                echo "<strong>" . $author . "</strong>";
            } else {
                echo "you";
            }
            ?>
        </li>
    </ul>
    <div class="tags" style="display:flex; flex:row">
        <form action="../editpost.php" method="post" style="margin: 10px">
            <input type="hidden" name="meme_id" value=<?php echo $id ?>>
            <input type="hidden" name="meme_name" value=<?php echo $title ?>>
            <?php
            if ($author == $_SESSION["name"]) {
                include "editpostbutton.php";
            }
            ?>
        </form>
        <form action="../savepost.php" method="post" style="margin: 10px">
            <input type="hidden" name="meme_id" value=<?php echo $id ?>>
            <?php
            if ($author != $_SESSION["name"]) {
                include "savepostbutton.php";
            }
            ?>
        </form>
        <form style="margin: 10px 10px 10px 0px">
            <?php
            if ($nsfw_post) {
                include "nsfwpostbutton.php";
            }
            ?>
        </form>
        
    </div>

</div>