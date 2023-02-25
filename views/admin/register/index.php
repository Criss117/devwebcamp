<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<?php 
    echo $pagination;
?>
<div class="dashboard__container">
    <?php if(!empty($register)){?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Email</th>
                    <th scope="col" class="table__th">Plan</th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($register as $reg): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $reg->user->name . ' ' .$reg->user->surname; ?>
                        </td>

                        <td class="table__td">
                            <?php echo $reg->user->email; ?>
                        </td>

                        <td class="table__td">
                            <?php echo $reg->package->name; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
    <?php }else{ ?>
        <p class="text-center">No hay registros aún</p>
    <?php } ?>    
</div>

<?php 
    echo $pagination;
?>