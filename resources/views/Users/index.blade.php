@extends('Layout.layout')

@section('titulo')
Users
@endsection


@section('title_content')
<h1><i class="fa fa-dashboard"></i>Users List</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="">Users</a></li>
@endsection

@section('content')
    <div class="clearfix">
    <div class="col-md-12" >
        <div class="tile"  id="crud" v-cloak>
            <div class="d-flex mb-2">
                  <h3 class="tile-title"><i class="fa fa-paw" aria-hidden="true"></i> Users</h3>
                <div class="float-right ml-auto">
                    <a class="btn btn-outline-success"  v-on:click.prevent="showCreate" href=""><i
                            class="fa fa-user-plus icon-expe"></i>Register</a>
                </div>
            </div>
            <div class="table-responsive" >
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Permissions</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="usuario in usuarios">
                            <td>@{{ usuario.name }}</td>
                            <td>@{{ usuario.username }}</td>
                            <td>
                                <span v-if="usuario.email">@{{ usuario.email }}</span>
                                <span v-else>Email no disponible</span>
                            </td>
                            <td>
                                <span v-if="usuario.permissions.length > 0" >
                                    <small class="badge badge-pill badge-success"  v-for="permission in usuario.permissions"> @{{permission.description}}</small>
                                </span>
                                <span v-if="usuario.roles.length > 0">
                                    <small class="badge badge-pill badge-info"  v-for="role in usuario.roles"> @{{role.name}}</small>
                                </span>
                            </td>
                            <td class="d-flex justify-content-center">
                                <a class="btn btn-outline-info mr-2" v-on:click.prevent="showUsuario(usuario)"><i class="fa fa-pencil icon-expe"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nav>
                <ul class="pagination d-flex justify-content-center">
                    <li v-if="pagination.current_page > 1" class="page-item" >
                        <a class='page-link' href="#" @click.prevent="changePage(pagination.current_page - 1)">
                            <span>Previos</span>
                        </a>
                    </li>

                    <li class='page-item' v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                        <a  class='page-link' href="#" @click.prevent="changePage(page)">
                            @{{ page }}
                        </a>
                    </li>

                    <li v-if="pagination.current_page < pagination.last_page">
                        <a class='page-link' href="#" @click.prevent="changePage(pagination.current_page + 1)">
                            <span>Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
            @include('Users.partials.create')
            @include('Users.partials.edit')
        </div>

    </div>
</div>



@endsection

@section('custom_javas')
<script src="{{ asset('js/custom/users/crud.js') }}" ></script>
@endsection
