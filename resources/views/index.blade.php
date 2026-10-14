
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

            <form class="todo-form" action="{{ route('tasks.store') }}" method="POST">
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
             <!-- Search -->
                {{-- <div class="search-box">
                    <form  action="{{route('tasks.s')}}" method="Get">
                        
                    <input
                        type="text"
                        name="searchValue"
                        id="searchValue"
                        placeholder="Search todos..."
                    >
                    <button type="submit" class="search-btn">Search</button>
                    </form>
                </div> --}}
         <!-- Todo List -->
        <div class="card">

            <!-- Table Header -->
            <div class="list-header">
                <div>
                    <h2>Todo List</h2>
                    <p>All your tasks are listed below</p>
                </div>

                <!-- Search -->
                <div class="search-box">
                    <form  action="{{route('tasks.index')}}" method="GET">
                    <input
                        type="text"
                        name="searchValue"
                        id="searchValue"
                        placeholder="Search todos..."
                        value="{{ request('searchValue') }}"
                    >
                    <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
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
                                    {{ $task->title }}
                                </span>
                            </td>

                            <td>
                                <span class="status status-completed">
                                    {{$task->status}}
                                </span>
                            </td>

                            <td>
                                <div class="action-buttons">

                                     <!-- Edit -->
                                    <form action="{{route('tasks.edit', $task->id)}}" method="GET">

                                        <button type="submit" class="action-btn edit-btn" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </form>
                                   
                                    

                                    <!-- Delete -->
                                    <form action="{{route('tasks.destroy', $task->id)}}" method="POST">
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
