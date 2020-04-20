<form method="POST"  v-on:submit.prevent="createUser">
<div class="modal fade" id='create' >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registrar usuario</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <label class="control-label">Name</label>
                <input :class="['form-control', errors.nombre ? 'is-invalid' : '']" type="text" v-model="newUsuario.name" name="name" placeholder="Enter name">
                <div v-if='errors.name' class="form-control-feedback text-danger">@{{ errors.name[0] }}</div>

            </div>
            <div class="form-group">
                <label class="control-label">Email</label>
                <input :class="['form-control', errors.email ? 'is-invalid' : '']" type="email" v-model="newUsuario.email" placeholder="Enter Email">
                <div v-if='errors.email' class="form-control-feedback text-danger">@{{ errors.email[0] }}</div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label class="control-label">Username</label>
                        <input :class="['form-control', errors.username ? 'is-invalid' : '']"  type="text" name="username" v-model="newUsuario.username" aria-describedby="usuarioHelp" placeholder="Enter Username">
                        <div v-if='errors.username' class="form-control-feedback text-danger">@{{ errors.username[0] }}</div>

                    </div>
                    <div class="col-6">
                        <label class="control-label">Password</label>
                        <input :class="['form-control', errors.password ? 'is-invalid' : '']" type="password" v-model="newUsuario.password" name="password" placeholder="Enter Password">
                        <div v-if='errors.password' class="form-control-feedback text-danger">@{{ errors.password[0] }}</div>
                            </div>
                    </div>
            <pre></pre>
            <div class="form-group" >
                <div class="row">
                    <div class="col-4 mr-0">
                        <label class="control-label">Assign administrator?</label>
                    </div>
                    <div class="col-8">
                        <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="role" v-on:click="changeAdmin" :checked="addRol">Admin
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <pre> </pre>
            </div>
            <div class="form-group" v-if="!addRol">
                <multiselect
                    :custom-label="customLabel"
                    :class="[ errors.permissions ? 'is-invalid' : '']"
                    v-model="newUsuario.permissions"
                    :options="permissions"
                    track-by="description" label="description"
                    :multiple="true">
                </multiselect>
                <div v-if='errors.permissions' class="form-control-feedback text-danger">@{{ errors.permissions[0] }}</div>

            </div>

        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Register</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal" >Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
