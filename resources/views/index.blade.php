<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Todo List</title>

    <!-- Bootstrap: used for Laravel pagination -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome icons -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <!-- Custom CSS: load after Bootstrap -->
    <link
        rel="stylesheet"
        href="{{ asset('style/main.css') }}"
    >
</head>

<body>

    <div class="todo-container">

        <!-- ==================================
             PAGE HEADER
        =================================== -->

        <div class="page-header">
            <h1>Todo List</h1>
            <p>Manage your tasks easily</p>
        </div>


        <!-- ==================================
             ADD TODO FORM
        =================================== -->

        <div class="todo-card">

            <div class="todo-card-header">
                <h2>Add Todo</h2>
            </div>

            <form
                class="todo-form"
                action="{{ route('tasks.store') }}"
                method="POST"
            >

                @csrf

                <!-- Title -->
                <div class="form-group">

                    <label for="title">Title</label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        placeholder="Enter todo title"
                        value="{{ old('title') }}"
                        required
                    >

                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                <!-- Description -->
                <div class="form-group">

                    <label for="description">Description</label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Enter todo description"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                <!-- Status -->
                <div class="form-group">

                    <label for="status">Status</label>

                    <select
                        id="status"
                        name="status"
                        required
                    >

                        <option value="">Select status</option>

                        <option
                            value="pending"
                            {{ old('status') == 'pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="in-progress"
                            {{ old('status') == 'in-progress' ? 'selected' : '' }}
                        >
                            In Progress
                        </option>

                        <option
                            value="completed"
                            {{ old('status') == 'completed' ? 'selected' : '' }}
                        >
                            Completed
                        </option>

                    </select>

                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>


                <!-- Submit button -->
                <div class="form-actions">

                    <button
                        type="submit"
                        class="todo-btn todo-btn-primary"
                    >
                        <i class="fa-solid fa-plus"></i>
                        Add Todo
                    </button>

                </div>

            </form>

        </div>


        <!-- ==================================
             TODO LIST
        =================================== -->

        <div class="todo-card">

            <!-- List header and search -->
            <div class="list-header">

                <div>
                    <h2>Todo List</h2>

                    <p>All your tasks are listed below</p>
                </div>


                <!-- Search form -->
                <div class="search-box">

                    <form
                        action="{{ route('tasks.index') }}"
                        method="GET"
                    >

                        <input
                            type="text"
                            name="searchValue"
                            id="searchValue"
                            placeholder="Search todos..."
                            value="{{ request('searchValue') }}"
                            aria-label="Search todos"
                        >

                        <button
                            type="submit"
                            class="search-btn"
                        >
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Search
                        </button>

                    </form>

                </div>

            </div>


            <!-- ==================================
                 RESTORE BUTTON
            =================================== -->

            <div class="restore-container">

                <a
                    href="{{ route('tasks.restoreView') }}"
                    class="todo-btn todo-btn-primary"
                >
                    <i class="fa-solid fa-trash-arrow-up"></i>
                    Restore
                </a>

            </div>


            <!-- ==================================
                 TASK TABLE
            =================================== -->

            <div class="table-wrapper">

                <table class="todo-table">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($tasks as $task)

                            <tr>

                                <!-- Serial number -->
                                <td>
                                    {{ $tasks->firstItem() + $loop->index }}
                                </td>


                                <!-- Task title -->
                                <td>
                                    <span class="todo-title">
                                        {{ $task->title }}
                                    </span>
                                </td>


                                <!-- Task status -->
                                <td>

                                    @php
                                        $statusClass = match ($task->status) {
                                            'completed' => 'status-completed',
                                            'in-progress' => 'status-progress',
                                            'pending' => 'status-pending',
                                            default => 'status-default',
                                        };
                                    @endphp

                                    <span class="status {{ $statusClass }}">
                                        {{ ucfirst(str_replace('-', ' ', $task->status ?? 'Unknown')) }}
                                    </span>

                                </td>


                                <!-- Action buttons -->
                                <td>

                                    <div class="action-buttons">

                                        <!-- Edit -->
                                        <form
                                            action="{{ route('tasks.edit', $task->id) }}"
                                            method="GET"
                                        >

                                            <button
                                                type="submit"
                                                class="action-btn edit-btn"
                                                title="Edit task"
                                                aria-label="Edit task"
                                            >
                                                <i class="fa-solid fa-pen"></i>
                                            </button>

                                        </form>


                                        <!-- Delete -->
                                        <form
                                            action="{{ route('tasks.destroy', $task->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this task?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                                title="Delete task"
                                                aria-label="Delete task"
                                            >
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="empty-results">

                                    @if (request('searchValue'))
                                        No tasks found for
                                        "{{ request('searchValue') }}".
                                    @else
                                        No tasks available. Add your first todo!
                                    @endif

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>


                <!-- ==================================
                     PAGINATION
                =================================== -->

                @if ($tasks->hasPages())
                <div class="pagination-container">
                    {{ $tasks->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @endif

            </div>

        </div>

    </div>

</body>

</html>