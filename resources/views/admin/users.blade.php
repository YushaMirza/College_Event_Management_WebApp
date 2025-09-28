@extends('admin.layouts.app')

@section('main')

@if(session('successMessage') )
        <div id="success-alert" class="alert alert-success position-absolute start-0 mt-5" style="z-index: 1000;">
            {{ session('successMessage') }}
        </div>
    @endif

    @if(session('errorMessage'))
        <div id="error-alert" class="alert alert-danger position-absolute start-0 mt-5" style="z-index: 1000;">
            {{ session('errorMessage') }}
        </div>
    @endif

<section class="manageUsers" style="padding: 50px 0">
    <div class="container">
        <div class="page-header justify-between d-flex flex-row">
            <div>
                <h2 class="page-title">Manage Users</h2>
                <div class="date-display">{{ now()->format('l, F j, Y') }}</div>
            </div>
            <div>
                <button class="btn btn-outline-light anouncement" onclick="location.href='{{url('/admin/notificationForm')}}'"><i class="fas fa-bullhorn me-1"></i> Send Announcement</button>
            </div>
        </div>

        <div class="controls-section">
            <form action="{{ route('user.search') }}" method="get" class="search-box">
                <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Search User...">
                <button type="submit" class="btn btn-primary btn-sm search-btn d-flex align-items-center justify-content-center p-2" title="Search">
    <i class="fas fa-search"></i>
</button>
            </form>
                
            <div class="filter-sort-container">
                                    <div class="filter-dropdown">

                <form action="{{ route('user.search') }}" method="get" class="filter-dropdown" id="departmentForm">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <select name="department" id="filterSelect" onchange="this.form.submit()">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                {{ $dept }}
                            </option>
                        @endforeach
                    </select>
                </form>

                                    </div>
                                    
            </div>
        </div>
        
        <!-- Users Table -->
        <div class="destinations-table-container">
            <h3 class="section-title">Users List</h3>

            <table id="destinationsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th @class([
                            'sortable' => true,
                            'sorted' => $currentSort === 'first_name',
                            'asc' => $currentSort === 'first_name' && $currentDirection === 'asc',
                            'desc' => $currentSort === 'first_name' && $currentDirection === 'desc'
                        ])>
                            <a href="{{ route('user.search', array_merge(request()->except(['sort', 'direction']), ['sort' => 'first_name', 'direction' => $currentSort === 'first_name' && $currentDirection === 'asc' ? 'desc' : 'asc'])) }}">
                                First Name
                                @if($currentSort === 'first_name')
                                    <i class="fas fa-sort-{{ $currentDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fas fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>Last Name</th>
                        <th @class([
                            'sortable' => true,
                            'sorted' => $currentSort === 'email',
                            'asc' => $currentSort === 'email' && $currentDirection === 'asc',
                            'desc' => $currentSort === 'email' && $currentDirection === 'desc'
                        ])>
                            <a href="{{ route('user.search', array_merge(request()->except(['sort', 'direction']), ['sort' => 'email', 'direction' => $currentSort === 'email' && $currentDirection === 'asc' ? 'desc' : 'asc'])) }}">
                                Email
                                @if($currentSort === 'email')
                                    <i class="fas fa-sort-{{ $currentDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fas fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>Phone</th>
                        <th @class([
                            'sortable' => true,
                            'sorted' => $currentSort === 'department',
                            'asc' => $currentSort === 'department' && $currentDirection === 'asc',
                            'desc' => $currentSort === 'department' && $currentDirection === 'desc'
                        ])>
                            <a href="{{ route('user.search', array_merge(request()->except(['sort', 'direction']), ['sort' => 'department', 'direction' => $currentSort === 'department' && $currentDirection === 'asc' ? 'desc' : 'asc'])) }}">
                                Department
                                @if($currentSort === 'department')
                                    <i class="fas fa-sort-{{ $currentDirection === 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fas fa-sort"></i>
                                @endif
                            </a>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->department }}</td>
                            <td class="actions-cell">
                                    <button type="button" class="action-btn view-btn" data-bs-toggle="modal" 
                                            data-bs-target="#userModal{{ $user->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                <form action="{{ route('user.toggleStatus', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    @if($user->status === 'active')
                                        <button type="submit" class="btn btn-sm btn-warning p-2" style="font-size: 0.75rem;" title="Suspend User">
                                            <i class="fas fa-user-slash" style="font-size: 0.8rem;"></i>
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-success p-2" style="font-size: 0.75rem;" title="Activate User">
                                            <i class="fas fa-user-check" style="font-size: 0.8rem;"></i>
                                        </button>
                                    @endif
                                </form>
                                <a href="{{ route('delete.user', $user->id) }}" class="action-btn delete-btn" title="Delete" 
                                onclick="return confirm('Are you sure you want to delete this user?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No users found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @foreach($users as $user)
    <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="userModalLabel{{ $user->id }}">User Details: {{ $user->first_name }} {{ $user->last_name }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <th>Full Name:</th>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Department:</th>
                                <td>{{ $user->department ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>{{ ucfirst($user->status) }}</td>
                            </tr>
                            <tr>
                                <th>Registered On:</th>
                                <td>{{ $user->created_at->format('M d, Y • h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Last Login:</th>
                                <td>{{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('M d, Y • h:i A') : 'Never' }}</td>
                            </tr>
                            <tr>
                                <th>Total Events Registered:</th>
                                <td>{{ $user->eventRegistrations->count() ?? 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>


document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 3000);
            }else if(errorAlert) {
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 3000);
            }
        });

document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 3000);
            }else if(errorAlert) {
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 3000);
            }
        });


    
    function updateSortDirection() {
        const sortSelect = document.getElementById('sortSelect');
        const sortDirection = document.getElementById('sortDirection');
        const currentSort = '{{ $currentSort }}';
        const currentDirection = '{{ $currentDirection }}';
        
        if (sortSelect.value === currentSort) {
            sortDirection.value = currentDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortDirection.value = 'asc';
        }
        
        document.getElementById('sortForm').submit();
    }
    
    // Handle department filter change
    document.getElementById('departmentSelect')?.addEventListener('change', function() {
        document.getElementById('departmentForm').submit();
    });
</script>
@endpush

<style>
    .sortable {
        cursor: pointer;
        position: relative;
        padding-right: 20px;
    }
    
    .sortable a {
        color: inherit;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .sortable i {
        font-size: 0.8em;
        opacity: 0.7;
    }
    
    .sortable.sorted i {
        opacity: 1;
    }
    
    .sortable:hover {
        background-color: #f5f5f5;
    }
    
    .filter-sort-container {
        display: flex;
        gap: 15px;
    }
    
    .filter-dropdown select,
    .sort-dropdown select {
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid #ddd;
        background-color: white;
    }

    .search-btn i {
    color: white;           /* Normal color */
    font-size: 0.9rem;
    transition: color 0.3s; /* Smooth transition */
}

.search-btn:hover i {
    color: #0d6efd;         /* Bootstrap primary blue on hover */
}

</style>
@endsection
