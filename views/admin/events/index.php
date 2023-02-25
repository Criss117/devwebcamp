<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
    <a class="dashboard__button" href="<?php echo $_ENV['HOST'];?>admin/events/create">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Evento
    </a>
</div>

<?php 
    echo $pagination;
?>
<div class="dashboard__container">
    <?php if(!empty($events)){?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th scope="col" class="table__th">Evento</th>
                    <th scope="col" class="table__th">Categoría</th>
                    <th scope="col" class="table__th">Día y Hora</th>
                    <th scope="col" class="table__th">Ponente</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach($events as $event): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $event->name; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->category->name; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->day->name . ' , ' .$event->hour->hour; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->speaker->name . ' ' . $event->speaker->surname; ?>
                        </td>

                        <td class="table__td--actions">
                            <a class="table__action table__action--update" href="/admin/events/update?id=<?php echo $event->eventId; ?>">
                                <i class="fa-solid fa-pencil"></i>
                                Editar
                            </a>

                            <form method="POST" action="/admin/events/delete" class="table__form">
                                <input type="hidden" name="eventId" value="<?php echo $event->eventId; ?>">
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
        <p class="text-center">No hay eventos aún</p>
    <?php } ?>    
</div>

<?php 
    echo $pagination;
?>