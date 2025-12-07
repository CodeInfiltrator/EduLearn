@extends('admin.layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Manage Teachers</h3>
    <button class="btn btn-primary" id="btnNewTeacher">+ Add Teacher</button>
</div>

<table class="table table-hover bg-white rounded shadow-sm" id="tableTeachers">
    <thead class="table-light">
        <tr>
            <th width="60">#</th>
            <th width="80">Photo</th>
            <th>Name</th>
            <th>Expertise</th>
            <th width="160">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teachers as $i => $t)
        <tr data-id="{{ $t->id }}">
            <td>{{ $i+1 }}</td>
            <td>
                <img src="{{ $t->photo ?? '/images/avatar-placeholder.png' }}" width="60" class="rounded shadow-sm">
            </td>
            <td class="teacher-name">{{ $t->name }}</td>
            <td class="teacher-expertise">{{ $t->expertise }}</td>
            <td>
                <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $t->id }}">Edit</button>
                <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $t->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- ================================ -->
<!-- Modal Create / Edit Teacher -->
<!-- ================================ -->
<div class="modal fade" id="modalTeacher" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" id="formTeacher" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTeacherTitle">New Teacher</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

          <input type="hidden" name="id" id="teacher_id">

          <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" id="teacher_name" name="name">
              <div class="invalid-feedback" id="err-name"></div>
          </div>

          <div class="mb-3">
              <label class="form-label">Expertise</label>
              <input type="text" class="form-control" id="teacher_expertise" name="expertise">
              <div class="invalid-feedback" id="err-expertise"></div>
          </div>

          <div class="mb-3">
              <label class="form-label">Photo</label>
              <input type="file" class="form-control" id="teacher_photo" name="photo" accept="image/*">

              <img id="previewPhoto" src="" width="130" class="rounded mt-3 shadow-sm" 
                   style="display:none; border:2px solid #eee;">
          </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveTeacher">Save</button>
      </div>

    </form>
  </div>
</div>

<!-- Toast Message -->
@include('admin._toast')

@endsection



@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const modalTeacher = new bootstrap.Modal(document.getElementById('modalTeacher'));
    const form = document.getElementById('formTeacher');
    const toastEl = document.getElementById('toast');
    const bsToast = new bootstrap.Toast(toastEl);

    /* ===========================
       NEW TEACHER BUTTON
    ============================*/
    document.getElementById('btnNewTeacher').addEventListener('click', () => {
        form.reset();
        clearErrors();
        document.getElementById('teacher_id').value = "";
        document.getElementById('modalTeacherTitle').innerText = "New Teacher";
        document.getElementById('previewPhoto').style.display = "none";
        modalTeacher.show();
    });


    /* ===========================
       LIVE PREVIEW FOR PHOTO
    ============================*/
    document.getElementById('teacher_photo').addEventListener('change', () => {
        let file = document.getElementById('teacher_photo').files[0];
        if(file){
            let reader = new FileReader();
            reader.onload = function(e){
                let img = document.getElementById('previewPhoto');
                img.src = e.target.result;
                img.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });


    /* ===========================
       EDIT TEACHER
    ============================*/
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', async () => {
            clearErrors();

            const id = btn.dataset.id;
            const res = await fetch(`/admin/teachers/${id}/edit`);
            const json = await res.json();

            if(json.status === 'success'){
                document.getElementById('modalTeacherTitle').innerText = "Edit Teacher";

                document.getElementById('teacher_id').value = json.data.id;
                document.getElementById('teacher_name').value = json.data.name;
                document.getElementById('teacher_expertise').value = json.data.expertise;

                // set preview image if exists
                if(json.data.photo){
                    previewPhoto.src = json.data.photo;
                    previewPhoto.style.display = 'block';
                }

                modalTeacher.show();
            }
        });
    });



    /* ===========================
       DELETE TEACHER
    ============================*/
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', async () => {
            if(!confirm('Delete this teacher?')) return;

            const id = btn.dataset.id;
            const res = await fetch(`/admin/teachers/${id}`, {
                method:'DELETE',
                headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'}
            });

            const json = await res.json();

            if(json.status === 'success'){
                document.querySelector(`tr[data-id="${id}"]`).remove();
                showToast(json.message);
            }
        });
    });



    /* ===========================
       SAVE TEACHER (CREATE/UPDATE)
    ============================*/
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearErrors();

        const id = document.getElementById('teacher_id').value;
        const url = id ? `/admin/teachers/${id}` : `/admin/teachers`;
        const fd = new FormData(form);

        if(id) fd.append('_method','PUT');

        const res = await fetch(url, {
            method:'POST',
            headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' },
            body: fd
        });

        if(res.status === 422){
            const json = await res.json();
            handleValidateErrors(json.errors);
            return;
        }

        const json = await res.json();

        if(json.status === 'success'){
            modalTeacher.hide();
            location.reload(); // refresh table
        }
    });



    /* ===========================
       HELPER FUNCTIONS
    ============================*/
    function clearErrors(){
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        ['err-name','err-expertise'].forEach(id => document.getElementById(id).innerText = "");
    }

    function handleValidateErrors(errors){
        if(errors.name){
            teacher_name.classList.add('is-invalid');
            document.getElementById('err-name').innerText = errors.name[0];
        }
        if(errors.expertise){
            teacher_expertise.classList.add('is-invalid');
            document.getElementById('err-expertise').innerText = errors.expertise[0];
        }
    }

    function showToast(msg){
        document.getElementById('toastBody').innerText = msg;
        bsToast.show();
    }
});
</script>
@endsection
