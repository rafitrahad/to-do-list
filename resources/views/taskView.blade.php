
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./style/main.css">

    <!-- Icons -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
</head>
<body>
            <form action="{{route('tasks.index')}}" method="GET">
              
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    HOME
                </button>
            </form>

        <!-- Todo List -->
        <div class="card">

            <!-- Table Header -->
            <div class="list-header">
                <div>
                    <h2>Todo List</h2>
                    <p>All your tasks are listed below</p>
                </div>

                <!-- Search -->
                {{-- <div class="search-box">
                    <form  action="{{route('tasks.index')}}" method="Get">
                        @csrf
                    <input
                        type="text"
                        name="searchValue"
                        id="query"
                        placeholder="Search todos..."
                    >
                    <button type="submit" class="search-btn">Search</button>
                    </form>
                </div> --}}
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
                                        type="button"
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
