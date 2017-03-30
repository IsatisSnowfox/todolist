<header class="wrapper grid">
    <div id="branding" class=""><a href="index.php">Todolist</a></div>
    <div class="ta-right"><a href="index.php?r=auth&a=getLogout">Déconnexion</a></div>
</header>
<div class="main-content wrapper">
    <h1>Vos prochaines tâches</h1>
    <ol class="tasks">
        <?php foreach ($_SESSION['tasks'] as $task): ?>
            <li>
                <div class="task grid">
                    <div class="column--heavy">
                        <?php if($_GET['id'] != $task['taskId']): ?>
                            <form action="index.php" method="post">
                                <label for="<?= $task['taskId']; ?>" class="checkbox ">
                                    <input title="Changer le statut" type="checkbox" id="<?= $task['taskId']; ?>" name="is_done">
                                    <span class="checkbox__label fs-base"><?= $task['taskDescription']; ?></span>
                                </label>
                                <input type="hidden" name="ressource" value="task">
                                <input type="hidden" name="action" value="postUpdate">
                                <input type="hidden" name="id" value="<?= $task['taskId']; ?>">
                                <button type="submit">Enregistrer</button>
                            </form>
                        <?php else: ?>
                            <form action="index.php" method="post">
                                <label for="29" class="checkbox">
                                    <input title="Changer le statut" type="checkbox" id="<?= $task['taskId']?>" name="is_done" value="0">
                                    <span class="checkbox__label"><?= $task['taskDescription']; ?></span>
                                </label>
                                <label for="description" class="textfield">
                                    <input type="text" size="40" value="<?= $task['taskDescription']; ?>" name="description" title="description" id="description">
                                    <span class="textfield__label"><?= $task['taskDescription']; ?></span>
                                </label>
                                <input type="hidden" name="ressource" value="task">
                                <input type="hidden" name="action" value="postUpdate">
                                <input type="hidden" name="id" value="<?= $task['taskId']; ?>">
                                <button type="submit">Enregistrer</button>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div>
                        <form action="index.php" method="get">
                            <button type="submit">modifier</button>
                            <input type="hidden" name="action" value="getUpdate">
                            <input type="hidden" name="ressource" value="task">
                            <input type="hidden" name="id" value="<?= $task['taskId']; ?>">
                        </form>
                    </div>
                    <div>
                        <form action="index.php" method="post">
                            <button type="submit">supprimer</button>
                            <input type="hidden" name="action" value="postDelete">
                            <input type="hidden" name="ressource" value="task">
                            <input type="hidden" name="id" value="<?= $task['taskId']; ?>">
                        </form>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>

    <hr>

    <h1>Ajouter une tâche</h1>
    <form action="index.php"
          method="post">
        <label for="description"
               class="textfield"><input type="text" name="description" id="description" size="80">
            <span class="textfield__label">Description</span>
        </label>
        <input type="hidden" name="ressource" value="task">
        <input type="hidden" name="action" value="create">
        <button type="submit">Créer cette nouvelle tâche</button>
    </form>
</div>
