<div
    class="app-container">
    <?php
    if (isset($_SESSION['user'])){
    ?>
    <h4>Editing <?php echo $_SESSION['user']['username'];
        ?> task</h4>
    <div class="row py-4 ">
        <form class="col-lg-4 " action="/tasks/edit?id=<?php echo $task[0]; ?>" method="post">
            <div class="form-group ">
                <input
                    name="title"
                    type="text"
                    class="form-control"
                    placeholder="Enter tasks title"
                    value="<?php echo $task['title']; ?>"
                />
            </div>
            <div class="form-group">
                <input
                    name="label"
                    type="text"
                    class="form-control"
                    placeholder="Enter task label"
                    value="<?php echo $task['label']; ?>"
                />
            </div>
            <div class="form-group">
                <label for="status">change status</label>
                <select name="done" id="status">
                    <option value="1">Done!</option>
                    <option value="0"<?php if ($task['done']==0) echo "selected"; ?>>Still waiting</option>
                </select>
            </div>
            <input type="submit"  value="Update" class="btn btn-primary mr-3 ">
        </form>
    </div>
<?php } else{?>
    <div>
        <h1>please sign in first to use the app</h1>
    </div>
<?php } ?>

</div>