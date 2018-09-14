<?php

namespace App\Controller;

Use App\Model\Role;


class RolesController extends Controller
{

    public function showRoles()
    {
        $sql = 'SELECT * FROM app_roles';
        $sth = $this->getPDO()->prepare($sql);
        $sth->execute();
        return $this->render('role/roles.html.php', [
            "roles" => $sth->fetchAll(\PDO::FETCH_CLASS, Role::class),
            "token" => $this->getToken()
        ]);
    }

    public function deleteRole($id)
    {
        if (!$this->isCsrfTokenValid()) {
            throw new \UnexpectedValueException("Invalid token");
        }

        $sql = "DELETE FROM `app_roles` WHERE `app_roles`.`id` =:id ";
        $sth = $this->getPDO()->prepare($sql);
        $sth->bindValue(":id", (int)$id, \PDO::PARAM_INT);
        $sth->execute();

        $response = $this->getResponse();
        $response->setHeader([
            "Location" => "./../../roles"
        ]);
        return $response;
    }

    public function createRole()
    {
        if (!$this->isCsrfTokenValid()) {
            throw new \UnexpectedValueException("Invalid token");
        }
        $name = filter_input(INPUT_POST, "name", FILTER_VALIDATE_REGEXP,[
            "options" => [
                "regexp" => Role::NAME
            ]
        ]);

        $value = filter_input(INPUT_POST, "value", FILTER_VALIDATE_REGEXP,[
                "options" => [
                    "regexp" => Role::VALUE
                ]
            ]);

        if($name && $value){
           $sql = "INSERT INTO `app_roles`(`name`, `value`) VALUES (:name, :value)";
            $sth = $this->getPDO()->prepare($sql);
            $sth->bindValue(":name", $name, \PDO::PARAM_INT);
            $sth->bindValue(":value", $value, \PDO::PARAM_INT);
            $sth->execute();
        }

        $response = $this->getResponse();
        $response->setHeader([
            "Location" => "./../../public/roles"
        ]);
        return $response;

    }

}
