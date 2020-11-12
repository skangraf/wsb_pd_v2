<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/views/panel/header.php');
$users = (new User)->getUsers();
var_dump($users);

?>
<!-- start of section uzytkownicy-->
<div id="page-content-wrapper-index">
    <section id="uzytkownicy">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="infobar">
                        <?php Messages::display(); ?>
                    </div>
                    <div class="lista-uzytkownikow">
                        <a href="/users/register" class="btn btn-primary">Dodaj nowego</a>
                        <h1>Lista użytkowników</h1>
                        <table id="zadaniaW" class="stripe hover"  style="width:100%">
                            <thead>
                                <tr>
                                    <th>Lp.</th>
                                    <th>Imię i Nazwisko</th>
                                    <th>E-mail</th>
                                    <th>Role</th>
                                    <th>Akcje</th>
                                </tr>
                            </thead>
                        <tbody>
                        <?php
                        $i=0;
                        foreach ($users as $user){

                            //get user role
                            $role = UsersController::userCan($user['id']);

                            //convert arrays roles to string
                            $role = implode(", ", $role);

                            $i++;

                            echo "<tr>
                                    <td>{$i}</td>
                                    <td>{$user['name']}</td>
                                    <td>{$user['email']}</td>
                                    <td>{$role}</td>
                                    <td>akcje</td>
                                </tr>";
                        }

                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Lp.</th>
                            <th>Imię i Nazwisko</th>
                            <th>E-mail</th>
                            <th>Akcje</th>
                        </tr>
                        </tfoot>
                        </table>


                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/views/panel/footer.php');
?>
