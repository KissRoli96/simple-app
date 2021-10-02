<?php
/** @var \app\models\User[] $params */
?>
<h3>Users list</h3>

<div class="container">
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($params as $key => $user) :
    ?>
    <tr>
        <th scope="row"><?= $user->id ?></th>
        <th><?= $user->name ?></th>
        <th>N/A</th>

    </tr>
    </tbody>
    <?php
    endforeach;
    ?>
</table>
</div>
