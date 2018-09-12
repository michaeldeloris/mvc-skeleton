<?php include __DIR__ . "/../base_open.html.php" ?>

<table>
    <tr>
        <th><h1>ID</h1></th>
        <th><h1>Name</h1></th>
        <th><h1>Value</h1></th>
    </tr>

    <?php foreach ($roles as $role) : ?>

        <tr>
            <td><?= $role->getID() ?></td>
            <td><?= $role->getName() ?></td>
            <td><?= $role->getValue() ?></td>
            <td> <a href="./roles/update/<?= $role->getName() ?>"  class="button">Update</a> </td>
            <td><a href="./roles/delete/<?= $role->getName() ?>" type="button" class="alert button">Delete</a> </td>
            <td></td>
        </tr>

    <?php endforeach; ?>
</table>

<?php include __DIR__ . "/../base_close.html.php" ?>
