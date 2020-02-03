<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Les sujets</h4>
            <div class="data-tables">
                <table id="usersTable" class="text-center">
                    <thead class="bg-light text-capitalize">
                    <tr>
                        <th>Nom</th>
                        <th>prénom</th>
                        <th>Age</th>
                        <th>Téle</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $row = "<tr>";
                        $row .= "<td>" . $user->nom . "</td>";
                        $row .= "<td>" . $user->prenom . "</td>";
                        $row .= "<td>" . $user->age . "</td>";
                        $row .= "<td>-</td>";
                        $row .= "<td><a href='index.php?action=users&user=" . $user->id . "'><i class='ti-user'></i></a></td>";
                        $row .= "</tr>";

                        echo $row;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>