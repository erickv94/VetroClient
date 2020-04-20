<form method="POST"  v-on:submit.prevent="updateUsuario">
        <div class="modal fade" id='edit' >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit User</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input :class="['form-control', errors.name ? 'is-invalid' : '']" type="text" v-model="fillUsuario.name" name="name" placeholder="Ingrese name Completo">
                        <div v-if='errors.name' class="form-control-feedback text-danger">@{{ errors.name[0] }}</div>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">Username</label>
                                <input :class="['form-control', errors.username ? 'is-invalid' : '']"  type="text" name="username" v-model="fillUsuario.username" aria-describedby="usuarioHelp">
                                <div v-if='errors.username' class="form-control-feedback text-danger">@{{ errors.username[0] }}</div>
                            </div>
                            <div class="col-6">
                                <label class="control-label">Email</label>
                                <input :class="['form-control', errors.email ? 'is-invalid' : '']" type="email" v-model="fillUsuario.email" >
                                <div v-if='errors.email' class="form-control-feedback text-danger">@{{ errors.email[0] }}</div>
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
                    <div class="form-group"  v-if="!addRol">
                       <multiselect
                          :custom-label="customLabel"
                          :class="[ errors.permissions ? 'is-invalid' : '']"
                          v-model="fillUsuario.permissions"
                          :options="permissions"
                          track-by="description" label="description"
                          :multiple="true">
                      </multiselect>
                      <div v-if='errors.permissions' class="form-control-feedback text-danger">@{{ errors.permissions[0] }}</div>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-primary mb-2" type="submit" v-on:click.prevent="changeContra">@{{ !verContra ? 'Change Password': 'No Change Password'}}</button>
                      <input :class="['form-control', errors.password? 'is-invalid' : '']" type="password" v-model="changePassword"  v-if="verContra" >
                        <div v-if='errors.password' class="form-control-feedback text-danger">@{{ errors.password[0] }}</div>
                    </div>

                <div class="modal-footer">
                  <button class="btn btn-primary" type="submit">Update</button>
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </form>
