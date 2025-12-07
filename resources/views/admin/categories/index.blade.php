@extends('admin.layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Manage Categories</h3>
    <div>
        <button class="btn btn-primary" id="btnNewCategory">+ New Category</button>
    </div>
</div>

<table class="table table-hover bg-white rounded shadow-sm" id="tableCategories">
    <thead class="table-light">
        <tr>
            <th width="60">#</th>
            <th>Name</th>
            <th>Description</th>
            <th width="160">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $i => $c)
        <tr data-id="{{ $c->id }}">
            <td>{{ $i+1 }}</td>
            <td class="cat-name">{{ $c->name }}</td>
            <td class="cat-desc">{{ $c->description }}</td>
            <td>
                <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $c->id }}">Edit</button>
                <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $c->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal Create/Edit -->
<div class="modal fade" id="modalCategory" tabindex="-1">
  <div class="modal-dialog">
    <form id="formCategory" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCategoryTitle">New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="id" id="category_id">
          <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" name="name" id="category_name" class="form-control" required>
              <div class="invalid-feedback" id="err-name"></div>
          </div>

          <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" id="category_description" class="form-control"></textarea>
              <div class="invalid-feedback" id="err-description"></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="saveCategory">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- Toast -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index:9999">
  <div id="toast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="toastBody">Saved</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalCategory = new bootstrap.Modal(document.getElementById('modalCategory'));
    const form = document.getElementById('formCategory');
    const toastEl = document.getElementById('toast');
    const bsToast = new bootstrap.Toast(toastEl);

    // New
    document.getElementById('btnNewCategory').addEventListener('click', () => {
        document.getElementById('modalCategoryTitle').innerText = 'New Category';
        form.reset();
        clearErrors();
        document.getElementById('category_id').value = '';
        modalCategory.show();
    });

    // Edit buttons
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            clearErrors();
            const id = btn.dataset.id;
            const res = await fetch(`/admin/categories/${id}/edit`);
            const json = await res.json();
            if(json.status === 'success'){
                document.getElementById('modalCategoryTitle').innerText = 'Edit Category';
                document.getElementById('category_id').value = json.data.id;
                document.getElementById('category_name').value = json.data.name;
                document.getElementById('category_description').value = json.data.description;
                modalCategory.show();
            }
        });
    });

    // Delete buttons
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', async () => {
            if(!confirm('Delete this category?')) return;
            const id = btn.dataset.id;
            const res = await fetch(`/admin/categories/${id}`, {
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });
            const json = await res.json();
            if(json.status === 'success'){
                // remove row
                document.querySelector(`tr[data-id="${id}"]`).remove();
                showToast(json.message);
            }
        });
    });

    // Submit create/update
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearErrors();
        const id = document.getElementById('category_id').value;
        const url = id ? `/admin/categories/${id}` : '/admin/categories';
        const method = id ? 'POST' : 'POST'; // use POST + _method for update
        const fd = new FormData(form);
        if(id) fd.append('_method','PUT');

        const res = await fetch(url, {
            method:'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: fd
        });

        if(res.status === 422){
            const json = await res.json();
            handleErrors(json.errors);
            return;
        }

        const json = await res.json();
        if(json.status === 'success'){
            modalCategory.hide();
            // If update: replace row; else reload for simplicity
            location.reload(); // simple approach
            showToast(json.message);
        }
    });

    function clearErrors(){
        document.querySelectorAll('.is-invalid').forEach(el=>el.classList.remove('is-invalid'));
        ['err-name','err-description'].forEach(id => {
            const d = document.getElementById(id);
            if(d) d.innerText = '';
        });
    }

    function handleErrors(errors){
        if(errors.name){
            document.getElementById('category_name').classList.add('is-invalid');
            document.getElementById('err-name').innerText = errors.name[0];
        }
        if(errors.description){
            document.getElementById('category_description').classList.add('is-invalid');
            document.getElementById('err-description').innerText = errors.description[0];
        }
    }

    function showToast(message){
        document.getElementById('toastBody').innerText = message;
        bsToast.show();
    }
});
</script>
@endsection
