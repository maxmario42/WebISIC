<main class="container mb-5" style="flex-grow:1;">
    <h1 class="text-center">Groupes</h1>
    <?php if ($this->getArg('groups')): ?>
        <div class="row justify-content-center">
			<div class="col table-responsive" style="max-width: 550px">
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Nom</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($this->getArg('groups') as $group): ?>
							<tr>
                                <th scope="row"><?php echo $this->safe($group); ?></th>
                                <td>
                                    <?php if ($this->getUser()->isInGroup($group)): ?>
                                        <a href="<?php echo $this->path('group_leave', array('id' => $group->getId())); ?>">
                                            <button class="btn btn-danger"><span class="fa fa-sign-out"></span> Quitter</button>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo $this->path('group_join', array('id' => $group->getId())); ?>">
                                            <button class="btn btn-success"><span class="fa fa-sign-in"></span> Rejoindre</button>
                                        </a>
                                    <?php endif ?>
                                    <a href="<?php echo $this->path('group_delete', array('id' => $group->getId())); ?>">
                                        <button class="btn btn-danger"><span class="fa fa-remove"></span> Supprimer</button>
                                    </a>
                                </td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
        </div>
    <?php else: ?>
        <div class="text-center mb-5">
            <h1>Aucun groupe</h1>
            <p>Aucun groupe n'a été ajouté pour le moment. Vous pouvez en ajouter dès maintenant.</p>
        </div>
    <?php endif ?>
    <?php if ($this->getUser()): ?>
        <div class="text-center">
            <a href="<?php echo $this->path('group_add'); ?>"><button class="btn btn-lg btn-primary my-2">
                <span class="fa fa-plus-circle"></span> Ajouter un groupe
            </button></a>
        </div>
    <?php endif ?>
</main>
