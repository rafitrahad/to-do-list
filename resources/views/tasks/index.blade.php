<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('style/main.css')}}">

    <!-- Icons -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
</head>
<body>

    <div class="container">

        <!-- Page Header -->
        <div class="page-header">
            {{-- @session('success')
                <div>
                    <h1>{{ $value }}</h1>
                </div>
            @endsession --}}
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div>
                <h1>Todo List</h1>
                <p>Manage your tasks easily</p>
            </div>
        </div>

        <!-- Todo Form -->
        <div class="card">
            <div class="card-header">
                <h2>Add Todo</h2>
            </div>

            <form class="todo-form"  action="{{url('/tasks')}}" method="POST" >
                @csrf
                <!-- Title -->
                <div class="form-group">
                    <label for="title">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        placeholder="Enter todo title"
                    >
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Enter todo description"
                    ></textarea>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="">Select status</option>
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        Add Todo
                    </button>
                </div>

            </form>
        </div>

        <!-- Todo List -->
        <div class="card">

            <!-- Table Header -->
            <div class="list-header">
                <div>
                    <h2>Todo List</h2>
                    <p>All your tasks are listed below</p>
                </div>

                <!-- Search -->
                <form action="{{ route('task.toSearch') }}"class="search-box" method="GET">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input
                        type="text"
                        placeholder="Search todos..."
                    >
                    <button type="submit" class="action-btn edit-btn"
                                            title="search" ></button>
                </form>
            </div>

            <!-- Table -->
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                   <tbody>

                        @foreach($tasks as $task)

                            <tr>
                                <td>{{ $task->id }}</td>

                                <td>
                                    <span class="todo-title">
                                        {{ ucfirst($task->title) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="status status-{{ $task->status }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="action-buttons">

                                        <!-- Edit -->
                                        <form action="{{ route('task.edit',$task->id) }}" method="GET">
                                        <button
                                            type="submit"
                                            class="action-btn edit-btn"
                                            title="Edit"
                                        >
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        </form>

                                        <!-- Delete -->
                                        <form action="{{ route('task.delete',$task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            title="Delete"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>

</body>
</html>
