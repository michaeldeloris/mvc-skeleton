<?php include __DIR__ . "/../base_open.html.php" ?>

<form method="post" action="roles/create">
    <div class="grid-container">
        <th><h1>Create role</h1></th>
        <div class="grid-x grid-padding-x">
            <div class="medium-6 cell">
                <label>Role name
                    <input name="name" type="text" placeholder="xxx">
                </label>
            </div>
            <div class="medium-6 cell">
                <label>Role value
                    <input name="value" type="text" placeholder="ROLE_XXX">
                </label>
            </div>
            <div class="medium-6 cell">
                <label>
                    <input name="token" type="hidden">
                </label>
            </div>
        </div>

    </div>
    <div class="medium-offset-9">
        <button class="button success" >Confirm</button>
    </div>
</form>

<table>
    <tr>
        <th><h1>ID</h1></th>
        <th><h1>Name</h1></th>
        <th><h1>Value</h1></th>
    </tr>

    <?php foreach ($roles as $role) : ?>

        <tr>
            <td style="text-align: center"><?= $role->getID() ?></td>
            <td style="text-align: center"><?= $role->getName() ?></td>
            <td style="text-align: center"><?= $role->getValue() ?></td>
            <td><a href="./roles/update/<?= $role->getId() ?> ?token=<?= $token ?>" class="button">Update</a></td>
            <td><a href="./roles/delete/<?= $role->getId() ?>?token=<?= $token ?>" type="button" class="alert button">Delete</a>
            </td>
            <td></td>
        </tr>

    <?php endforeach; ?>
</table>

<?php include __DIR__ . "/../base_close.html.php" ?>
