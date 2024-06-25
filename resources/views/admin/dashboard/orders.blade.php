@extends('layouts.admin-master')

@section('title')
    Pesanan
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pesanan</h1>
        </div>

        <div class="section-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab"
                        aria-controls="pending" aria-selected="true">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="proses-tab" data-toggle="tab" href="#proses" role="tab"
                        aria-controls="proses" aria-selected="false">Diproses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done"
                        aria-selected="false">Done</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- Pending Orders -->
                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Menu Item</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingOrders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->details->first()->menu->category->name }}</td>
                                        <td>{{ $order->details->first()->menu->name }}</td>
                                        <td>{{ $order->details->first()->quantity }}</td>
                                        <td>{{ $order->details->first()->total_price }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editModal{{ $order->id }}">Edit</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteModal{{ $order->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- In Progress Orders -->
                <div class="tab-pane fade" id="proses" role="tabpanel" aria-labelledby="proses-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Menu Item</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inProgressOrders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->details->first()->menu->category->name }}</td>
                                        <td>{{ $order->details->first()->menu->name }}</td>
                                        <td>{{ $order->details->first()->quantity }}</td>
                                        <td>{{ $order->details->first()->total_price }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editModal{{ $order->id }}">Edit</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteModal{{ $order->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Done Orders -->
                <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Menu Item</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doneOrders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->details->first()->menu->category->name }}</td>
                                        <td>{{ $order->details->first()->menu->name }}</td>
                                        <td>{{ $order->details->first()->quantity }}</td>
                                        <td>{{ $order->details->first()->total_price }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#editModal{{ $order->id }}">Edit</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteModal{{ $order->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Edit Modal -->
    @foreach ($pendingOrders as $order)
        <div class="modal fade" id="editModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="editModal{{ $order->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $order->id }}Label">Edit Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Diproses
                                    </option>
                                    <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($inProgressOrders as $order)
        <div class="modal fade" id="editModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="editModal{{ $order->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $order->id }}Label">Edit Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Diproses
                                    </option>
                                    <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($doneOrders as $order)
        <div class="modal fade" id="editModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="editModal{{ $order->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal{{ $order->id }}Label">Edit Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Diproses
                                    </option>
                                    <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Delete Modal -->
    @foreach ($pendingOrders as $order)
        <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="deleteModal{{ $order->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal{{ $order->id }}Label">Delete Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <p>Are you sure you want to delete this order?</p>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($inProgressOrders as $order)
        <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="deleteModal{{ $order->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal{{ $order->id }}Label">Delete Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <p>Are you sure you want to delete this order?</p>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($doneOrders as $order)
        <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="deleteModal{{ $order->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal{{ $order->id }}Label">Delete Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <p>Are you sure you want to delete this order?</p>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
