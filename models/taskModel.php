<?php
function getTasksList() {
    $db = connectDb();
    try {
        $statement = $db->prepare('SELECT tasks.id AS taskId, tasks.description AS taskDescription, tasks.is_done AS taskIsDone
                                    FROM tasks
                                    LEFT JOIN task_user ON tasks.id = task_user.task_id
                                    LEFT JOIN users ON task_user.user_id = users.id
                                    WHERE users.id = :userId
                                    ORDER BY description ASC');
        $statement->bindParam(':userId', $_SESSION['user']['id']);
        $statement->execute();
        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        return false;
    }
    $_SESSION['tasks'] = $tasks;

    return $_SESSION['tasks'];
}

function updateTask() {
    $db = connectDb();
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $db->prepare('UPDATE tasks
                                    SET description = :description, is_done = :is_done
                                    WHERE id = :id');
        $statement->bindParam(':id', $_POST['id']);
        $statement->bindParam(':description', $_POST['description']);
        $statement->bindParam(':is_done', $_POST['is_done']);
        $statement->execute();
    } catch (PDOException $error) {
        var_dump($error);
        die();
        return false;
    }

    return true;
}

function createTask() {
    $db = connectDb();
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $db->prepare('INSERT INTO tasks(`description`) VALUES(:description)');
        $statement->bindParam(':description', $_POST['description']);
        $statement->execute();

        $statement = $db->prepare('INSERT INTO task_user(`task_id`, `user_id`) VALUES(:task_id, :user_id)');
        $statement->bindParam(':task_id', $db->lastInsertId());
        $statement->bindParam(':user_id', $_SESSION['user']['id']);
        $statement->execute();
    } catch (PDOException $error) {
        var_dump($error);
        die();
        return false;
    }

    return true;
}

function deleteTask() {
    $db = connectDb();
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $db->prepare('DELETE FROM tasks WHERE id = :id');
        $statement->bindParam(':id', $_POST['id']);
        $statement->execute();

        $statement = $db->prepare('DELETE FROM task_user WHERE task_id = :id');
        $statement->bindParam(':id', $_POST['id']);
        $statement->execute();
    } catch (PDOException $error) {
        var_dump($error);
        die();
        return false;
    }

    return true;
}
