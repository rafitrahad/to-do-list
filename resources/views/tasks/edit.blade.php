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

            <form class="todo-form"  action="{{ route('task.update', $task->id) }}" method="POST" >
                @csrf
                  
                <!-- Title -->
                <div class="form-group">
                    <label for="title">Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value={{$task->title}}
                    >
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        
                    >{{$task->description}}</textarea>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value={{$task->status}}>{{$task->status}}</option>
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i>
                        UPDATE Todo
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
