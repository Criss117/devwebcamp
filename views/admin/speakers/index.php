<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
    <a class="dashboard__button" href="<?php echo $_ENV['HOST'];?>admin/speakers/create">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Ponente
    </a>
</div>
<?php 
    echo $pagination;
?>
<div class="dashboard__container">
    <?php if(!empty($speakers)){?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Ubicacion</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($speakers as $speaker): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $speaker->name . ' ' .$speaker->surname; ?>
                        </td>

                        <td class="table__td">
                            <?php echo $speaker->city . ', ' .$speaker->country; ?>
                        </td>

                        <td class="table__td--actions">
                            <a class="table__action table__action--update" href="/admin/speakers/update?id=<?php echo $speaker->speakerId; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>

                            <form method="POST" action="/admin/speakers/delete" class="table__form">
                                <input type="hidden" name="speakerId" value="<?php echo $speaker->speakerId; ?>">
                                <button type="submit" class="table__action table__action--delete">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
    <?php }else{ ?>
        <p class="text-center">No hay ponentes aún</p>
    <?php } ?>    
</div>

<?php 
    echo $pagination;
?>