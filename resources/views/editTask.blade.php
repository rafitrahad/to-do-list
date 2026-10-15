<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Todo</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('style/main.css') }}">

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
</head>

<body>

    <div class="todo-container">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>
                    <i class="fa-solid fa-list-check"></i>
                    Todo List
                </h1>
                <p>Manage your tasks easily</p>
            </div>
        </div>

        <!-- Edit Todo Card -->
        <div class="todo-card">

            <div class="todo-card-header">
                <h2>
                    <i class="fa-solid fa-pen-to-square"></i>
                    Edit Todo
                </h2>
                <p>Update your task details below</p>
            </div>

            <!-- Existing form functionality preserved -->
            <form
                class="todo-form"
                action="{{ route('tasks.update', $task->id) }}"
                method="POST"
            >
                @csrf

                <!-- Title -->
                <div class="form-group">
                    <label for="title">
                        <i class="fa-solid fa-heading"></i>
                        Task Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        placeholder="Enter task title"
                        value="{{ $task->title }}"
                        required
                    >
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">
                        <i class="fa-solid fa-align-left"></i>
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="5"
                        placeholder="Enter task description"
                    >{{ $task->description }}</textarea>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status">
                        <i class="fa-solid fa-spinner"></i>
                        Task Status
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select"
                    >
                        <option value="{{ $task->status }}">
                            {{ $task->status }}
                        </option>

                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="form-actions">

                    <button type="submit" class="todo-btn todo-btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Update Task
                    </button>

                    <a href="{{ route('tasks.index') }}" class="todo-btn todo-btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i>
                        Back to Tasks
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>