<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title"><?php echo $user->nom . ' ' . $user->prenom . " (" .$user->age ." ans)"?></h4>
            <div class="data-tables">
                <table id="usersTable" class="text-center">
                    <thead class="bg-light text-capitalize">
                    <tr>
                        <th>Image</th>
                        <th>Status</th>
                        <th>path</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($user->getTests() as $testedImage){
                        $row = "<tr>";
                        $row .= "<td> pas encore resigned</td>";
                        $row .= "<td  ". (false? "class='badge badge-success'> passed" : "class='badge badge-danger'> Non passé") ."</td>";
                        $row .= "<td> ". $testedImage['imagePath'] ."</td>";
                        $row .= "</tr>";
                        echo $row;
                    }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>