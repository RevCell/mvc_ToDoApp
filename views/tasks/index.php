

<div
    class="app-container">
    <?php
    if (isset($_SESSION['user'])){
    ?>
    <h4>Create new task</h4>
        <div class="row py-4 ">
            <form class="col-lg-4 " action="/tasks" method="post">
                <div class="form-group ">
                    <input
                        name="title"
                        type="text"
                        class="form-control"
                        placeholder="Enter tasks title"
                    />
                </div>
                <div class="form-group">
                    <input
                        name="label"
                        type="text"
                        class="form-control"
                        placeholder="Enter task label"
                    />
                </div>
                <input type="submit"  value="ADD" class="btn btn-primary mr-3 ">
            </form>
        </div>
        <div>
            <?php
            echo "welcome back ".$_SESSION['user']['email']." !";
            ?>
        </div>
        <div class="table-wrapper col-lg-4">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>task title</th>
                    <th>label</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <?php $counter=1;  ?>
                <?php foreach ($tasks as $task): ?>
                <tbody>
                <tr>
                    <th><?php echo $counter;  ?></th>
                    <td><?php echo $task['title'] ?></td>
                    <td><?php echo $task['label'] ?></td>
                    <td>
                        <?php if(empty($task['done'])){
                        echo "still waiting";
                        }
                        else{
                            echo "done!";
                        } ?></td>
                    <td>
                        <a class="btn btn-danger" href="/tasks/delete?task_id=<?php echo $task['id'] ?>">
                            Delete
                        </a>
                        <a href="/tasks/edit?id=<?php echo $task['id'] ?>" class="btn btn-success text-center" style="color: white">
                            Edit
                        </a>
                    </td>
                </tr>
                </tbody>
                <?php $counter++;  ?>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
    <?php } else{?>
    <div>
        <h1>please login first to use the app</h1>
    </div>
    <?php } ?>

</div>