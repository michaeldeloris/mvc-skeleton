<?php

namespace App\Controller;

Use App\Model\Role;


class RolesController extends Controller
{

    function showRoles()
    {
        $sql = 'SELECT * FROM app_roles';
        $sth = $this->getPDO()->prepare($sql);
        $sth->execute();
        $roles = $sth->fetchAll(\PDO::FETCH_CLASS, Role::class);
        return $this->render('role/roles.html.php', [
            "roles" => $roles
        ]);
    }

    function deleteRole()
    {
        exit;

    }

}
