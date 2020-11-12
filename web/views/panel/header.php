<?php

    if(!isset($_SESSION['is_logged_in'])){
        Controller::redirect('users', 'login');
    }

    $userCan = UsersController::userCan();

?>

<div id="wrapper" class="toggled">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div id="menu-toggle" class="toogle-menu">
            <div id="close" class="fas fa-angle-double-left"></div>
        </div>
        <ul class="sidebar-nav">
            <?php
                if (in_array('biuro',$userCan)){
                    echo '
                        <li>
                             <a href="/panel/kalendarz">Kalendarz</a>
                        </li>
                    ';
                }

                if (in_array('mechanik',$userCan)){
                    echo '
                            <li>
                                <a href="/panel/rezerwacje">Rezerwacje</a>
                            </li>
                        ';
                }

                if (in_array('admin',$userCan)){
                    echo '
                                <li>
                                    <a href="/users/lists">Użytkownicy</a>
                                </li>
                            ';
                }
            ?>
            <li>
                <a href="/users/logout">Wyloguj</a>
            </li>
        </ul>
    </div>