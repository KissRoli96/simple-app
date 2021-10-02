<?php
/** @var \app\models\Advertisement[] $params  */
?>

<h3>Advertisements list</h3>

<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Title</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($params as $key => $ad) :
        ?>
        <tr>
            <th scope="row"><?= $ad->id ?></th>
            <th><?= $ad->user->name ?></th>
            <th><?= $ad->title ?></th>
        </tr>
        </tbody>
        <?php
        endforeach;
        ?>
    </table>
</div>