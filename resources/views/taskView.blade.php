<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Restore Tasks</title>

    <!-- CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('style/main.css') }}"
    >

    <!-- Icons -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
</head>

<body>

    <div class="todo-container">

        <!-- ==================================
             PAGE HEADER
        =================================== -->

        <div class="page-header">

            <h1>Restore Tasks</h1>

            <p>
                Restore your deleted tasks
            </p>

        </div>


        <!-- ==================================
             RESTORE CARD
        =================================== -->

        <div class="todo-card">

            <!-- ==================================
                 CARD HEADER
            =================================== -->

            <div class="list-header">

                <div>

                    <h2>Deleted Tasks</h2>

                    <p>
                        All your deleted tasks are listed below
                    </p>

                </div>


                <!-- HOME BUTTON -->

                <a
                    href="{{ route('tasks.index') }}"
                    class="todo-btn todo-btn-primary"
                >
                    <i class="fa-solid fa-house"></i>
                    Home
                </a>

            </div>


            <!-- ==================================
                 TABLE
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

                        @forelse($tasks as $task)

                            <tr>

                                <!-- ID -->

                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <!-- TITLE -->

                                <td>

                                    <span class="todo-title">
                                        {{ $task->title }}
                                    </span>

                                </td>


                                <!-- STATUS -->

                                <td>

                                    @php

                                        $statusClass = match ($task->status) {

                                            'completed' =>
                                                'status-completed',

                                            'in-progress' =>
                                                'status-progress',

                                            'pending' =>
                                                'status-pending',

                                            default =>
                                                'status-default',

                                        };

                                    @endphp


                                    <span class="status {{ $statusClass }}">

                                        {{ ucfirst(
                                            str_replace(
                                                '-',
                                                ' ',
                                                $task->status ?? 'Unknown'
                                            )
                                        ) }}

                                    </span>

                                </td>


                                <!-- ACTION -->

                                <td>

                                    <div class="action-buttons">

                                        <a
                                            href="{{ route('tasks.restoreTask', $task->id) }}"
                                            class="todo-btn todo-btn-primary"
                                        >

                                            <i class="fa-solid fa-trash-arrow-up"></i>

                                            Restore

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="empty-results"
                                >

                                    No deleted tasks found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>