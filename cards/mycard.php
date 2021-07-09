    <div class="card mb-3 w-20" style="width: 18rem;">
        <img src=<?php echo $link ?> class="card-img-top" alt="Error loading image">
        <div class="card-body">
            <h5 class="card-title"><?php echo $title ?></h5>
        </div>
        <ul class="list-group list-group-flush">
            <div class="tags" style="display:flex; flex:row">
                <form action="../removepost.php" method="post" style="margin: 10px">
                    <input type="hidden" name="meme_id" value=<?php echo $id ?>>
                    <button type="submit" class="btn btn-danger">Delete </button>
                </form>
            </div>
        </ul>

    </div>