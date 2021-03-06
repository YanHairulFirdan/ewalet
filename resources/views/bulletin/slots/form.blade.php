<form class="d-inline" action="{{ route('post.password', ['bulletin' => $bulletin->id]) }}" method="POST">
    @method('POST')
    @csrf
    <div class="row d-flex justify-content-between">
        <div class="col-md-8">
            <div class="form-group mx-sm-3 mb-2">
                <label for="inputPassword2" class="sr-only">Password</label>
                <input type="password" class="form-control" name="password" id="inputPassword2" placeholder="Password">
            </div>
        </div>
        <div class="col-md-4">
            @if (Session::get('delete'))
                <button type="submit" name="submit_delete" value="delete" class="btn btn-danger mb-2"
                    data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash p-3"></i></button>
            @endif
            @if (Session::get('edit'))
                <button type="submit" name="submit_edit" value="edit" class="btn btn-default mb-2" data-toggle="modal"
                    data-target="#editModal"><i class="fa fa-pencil p-3"></i></button>
            @endif
        </div>
    </div>
</form>
