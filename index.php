<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONOSPACE</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="hover-underline">MONOSPACE</div><br>
    <div class="line"></div>
    <div class="container">
        <div class="square">
            <div class="task-container"></div>
            <form action="addtask.php" method="post">
                <div class="task-input-wrapper">
                    <input placeholder="ADD NEW TASK" type="text" name="name" class="taskfield">
                    <input type="submit" value="Submit" class="submitbutton">
                    <select name="status" id="status" class="selection">
                        <option value="None" selected> None</option>
                        <option value="Pending">Pending</option>
                        <option value="In progress">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                </div>
            </form>
            <script>
            const container = document.querySelector('.task-container');

            container.addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-btn')) {
                    const taskid = event.target.closest('li').dataset.taskid;
                    const formData = new FormData();
                    formData.append('id', taskid);
                    fetch('deletetask.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(result => {
                        loadTasks();
                    });
                }
            });

            container.addEventListener('change', function(event) {
                if (event.target.classList.contains('status-select')) {
                    const taskid = event.target.closest('li').dataset.taskid;
                    const formData = new FormData();
                    formData.append('id', taskid);
                    formData.append('status', event.target.value);
                    fetch('updatestatus.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(result => {
                        loadTasks();
                    });
                }
            });

            function loadTasks() {
                fetch('gettasks.php')
                .then(response => response.json())
                .then(tasks => {
                    container.innerHTML = '';
                    tasks.forEach(task => {
                        const li = document.createElement('li');
                        li.dataset.taskid = task.id;

                        const textSpan = document.createElement('span');
                        textSpan.textContent = task.name;
                        if (task.status == 'Done') {
                            textSpan.style.textDecoration = "line-through";
                        }
                        li.appendChild(textSpan);

                        const statusSelect = document.createElement('select');
                        statusSelect.classList.add('status-select');
                        ['None', 'Pending', 'In progress', 'Done'].forEach(statusOption => {
                            const opt = document.createElement('option');
                            opt.value = statusOption;
                            opt.textContent = statusOption;
                            if (task.status === statusOption) {
                                opt.selected = true;
                            }
                            statusSelect.appendChild(opt);
                        });
                        li.appendChild(statusSelect);

                        const deleteBtn = document.createElement('button');
                        deleteBtn.textContent = '✕';
                        deleteBtn.classList.add('delete-btn');
                        li.appendChild(deleteBtn);

                        container.appendChild(li);
                    });
                });
            }
            loadTasks();
            document.querySelector('form').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                fetch('addtask.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    this.reset();
                    loadTasks();
                });
            });
            </script>
        </div>
    </div>
</body>
</html>