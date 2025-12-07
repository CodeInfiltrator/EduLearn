@extends('admin.layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Manage Courses</h3>
    <button class="btn btn-primary" id="btnNewCourse">+ Add Course</button>
</div>

<table class="table table-hover bg-white rounded shadow-sm" id="tableCourses">
    <thead class="table-light">
        <tr>
            <th width="60">#</th>
            <th>Title</th>
            <th width="220">Category</th>
            <th width="220">Teacher</th>
            <th width="160">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $i => $c)
        <tr data-id="{{ $c->id }}">
            <td>{{ $i+1 }}</td>
            <td class="course-title">{{ $c->title }}</td>
            <td class="course-cat">{{ $c->category->name ?? '-' }}</td>
            <td class="course-teacher">{{ $c->teacher->name ?? '-' }}</td>
            <td>
                <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $c->id }}">Edit</button>
                <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $c->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- ================================ -->
<!-- Modal Create / Edit Course -->
<!-- ================================ -->
<div class="modal fade" id="modalCourse" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form class="modal-content" id="formCourse">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCourseTitle">New Course</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

          <input type="hidden" name="id" id="course_id">

          <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" id="course_title" name="title">
              <div class="invalid-feedback" id="err-title"></div>
          </div>

          <div class="mb-3 row">
              <div class="col-md-6">
                  <label class="form-label">Category</label>
                  <select class="form-select" id="course_category" name="category_id">
                      <option value="">-- Select Category --</option>
                      @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback" id="err-category"></div>
              </div>

              <div class="col-md-6">
                  <label class="form-label">Teacher</label>
                  <select class="form-select" id="course_teacher" name="teacher_id">
                      <option value="">-- Select Teacher --</option>
                      @foreach($teachers as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback" id="err-teacher"></div>
              </div>
          </div>

          <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea id="course_description" name="description"></textarea>
              <div class="invalid-feedback d-block" id="err-description"></div>
          </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveCourse">Save</button>
      </div>

    </form>
  </div>
</div>

@include('admin._toast')

@endsection

@section('scripts')
<!-- TinyMCE CDN -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // init TinyMCE
    tinymce.init({
        selector: '#course_description',
        height: 300,
        menubar: false,
        plugins: 'lists link image table hr code',
        toolbar: 'undo redo | bold italic underline | bullist numlist | alignleft aligncenter alignright | link code',
        branding: false
    });

    const modalCourse = new bootstrap.Modal(document.getElementById('modalCourse'));
    const form = document.getElementById('formCourse');
    const toastEl = document.getElementById('toast');
    const bsToast = new bootstrap.Toast(toastEl);

    // NEW
    document.getElementById('btnNewCourse').addEventListener('click', () => {
        form.reset();
        tinymce.get('course_description')?.setContent('');
        clearErrors();
        document.getElementById('course_id').value = "";
        document.getElementById('modalCourseTitle').innerText = "New Course";
        modalCourse.show();
    });

    // EDIT
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', async () => {
            clearErrors();
            const id = btn.dataset.id;
            const res = await fetch(`/admin/courses/${id}/edit`);
            const json = await res.json();

            if(json.data){
                document.getElementById('modalCourseTitle').innerText = "Edit Course";
                document.getElementById('course_id').value = json.data.id;
                document.getElementById('course_title').value = json.data.title;
                document.getElementById('course_category').value = json.data.category_id;
                document.getElementById('course_teacher').value = json.data.teacher_id;
                tinymce.get('course_description')?.setContent(json.data.description || '');
                modalCourse.show();
            }
        });
    });

    // DELETE
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', async () => {
            if(!confirm('Delete this course?')) return;
            const id = btn.dataset.id;
            const res = await fetch(`/admin/courses/${id}`, {
                method:'DELETE',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });
            const json = await res.json();
            if(json.status === 'success'){
                document.querySelector(`tr[data-id="${id}"]`).remove();
                showToast(json.message);
            } else {
                showToast('Failed to delete', true);
            }
        });
    });

    // SAVE (Create / Update)
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearErrors();

        const id = document.getElementById('course_id').value;
        const url = id ? `/admin/courses/${id}` : `/admin/courses`;
        const fd = new FormData();

        fd.append('title', document.getElementById('course_title').value);
        fd.append('category_id', document.getElementById('course_category').value);
        fd.append('teacher_id', document.getElementById('course_teacher').value);
        fd.append('description', tinymce.get('course_description')?.getContent() || '');

        if(id) fd.append('_method','PUT');

        const res = await fetch(url, {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: fd
        });

        if(res.status === 422){
            const json = await res.json();
            handleValidationErrors(json.errors);
            return;
        }

        const json = await res.json();

        if(json.status === 'success'){
            modalCourse.hide();
            // simple approach: reload to update table rows
            location.reload();
            showToast(json.message);
        } else {
            showToast('Operation failed', true);
        }
    });

    /* ========== Helpers ========== */
    function clearErrors(){
        ['err-title','err-category','err-teacher','err-description'].forEach(id => {
            let el = document.getElementById(id);
            if(el) el.innerText = '';
        });
        ['course_title','course_category','course_teacher'].forEach(id=>{
            let i = document.getElementById(id);
            if(i) i.classList.remove('is-invalid');
        });
    }

    function handleValidationErrors(errors){
        if(errors.title){
            document.getElementById('course_title').classList.add('is-invalid');
            document.getElementById('err-title').innerText = errors.title[0];
        }
        if(errors.category_id){
            document.getElementById('course_category').classList.add('is-invalid');
            document.getElementById('err-category').innerText = errors.category_id[0];
        }
        if(errors.teacher_id){
            document.getElementById('course_teacher').classList.add('is-invalid');
            document.getElementById('err-teacher').innerText = errors.teacher_id[0];
        }
        if(errors.description){
            document.getElementById('err-description').innerText = errors.description[0];
        }
    }

    function showToast(msg, danger=false){
        const toastBody = document.getElementById('toastBody');
        const toastElRoot = document.getElementById('toast');
        toastBody.innerText = msg;
        toastElRoot.classList.remove('bg-success','bg-danger');
        toastElRoot.classList.add(danger ? 'bg-danger' : 'bg-success');
        bsToast.show();
    }

});
</script>
@endsection
