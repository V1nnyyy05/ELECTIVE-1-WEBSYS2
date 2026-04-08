@extends('layout')

@section('content')
<div class="container mt-4">
    

    <h3 class="mb-3">System Logs & User Management</h3>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Log ID</th>
                            <th>User Name</th>
                            <th>Action</th>
                            <th>Date & Time</th>
                            <th class="text-center">Manage User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        <tr>
                            <td class="align-middle">{{ $log->id }}</td>
                            <td class="align-middle fw-bold">{{ $log->first_name }} {{ $log->last_name }}</td>
                            <td class="align-middle">
                                @if($log->action == 'Logged in')
                                    <span class="badge bg-success">{{ $log->action }}</span>
                                @elseif($log->action == 'Logged out')
                                    <span class="badge bg-secondary">{{ $log->action }}</span>
                                @elseif($log->action == 'Created a new account')
                                    <span class="badge bg-primary">{{ $log->action }}</span>
                                @else
                                    {{ $log->action }}
                                @endif
                            </td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($log->created_at)->format('M d, Y h:i A') }}</td>
                            <td class="text-center align-middle">
                                <a href="/profile/{{ $log->user_id }}" class="btn btn-sm btn-primary">Update</a>
                                
                                <form action="/delete-user/{{ $log->user_id }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection