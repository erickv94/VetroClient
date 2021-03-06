new Vue({
    el: "#crud",
    components:{ Multiselect:window.VueMultiselect.default},
    created() {
        this.getUsuarios();
    },
    data:{
        usuarios:[],
        permissions:[],
        roles:[],
        addRol:false,
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
        },
        verContra: false,
        changePassword: '',
        newUsuario: {
            'name':null,
            'username':null,
            'email': null,
            'password': null,
            'permissions': [],
        },

        fillUsuario:{
            'name':null,
            'username':null,
            'email': null,
            'permissions':[],
            'role':null
        },

        errors:{},
        offset:2,
        usuarioActual: '',
        passwordTemporal:''
    },

    computed: {
		isActived: function() {
			return this.pagination.current_page;
		},
		pagesNumber: function() {
			if(!this.pagination.to){
				return [];
			}

			var from = this.pagination.current_page - this.offset;
			if(from < 1){
				from = 1;
			}

			var to = from + (this.offset * 2);
			if(to >= this.pagination.last_page){
				to = this.pagination.last_page;
			}

			var pagesArray = [];
			while(from <= to){
				pagesArray.push(from);
				from++;
			}
			return pagesArray;
        }

    },
    methods: {
           customLabel ({description}){
            return `${description}`
        },
        getUsuarios: function(page){
            let url="/users/list?page="+this.pagination.current_page;
            axios.get(url).then(response=> {
                this.usuarios=response.data.users.data;
                this.pagination=response.data.pagination;
                this.permissions=response.data.permissions;
                this.roles = response.data.roles;
            });
        },
        changePage: function(page) {
			this.pagination.current_page = page;
			this.getUsuarios(page);
        },
        showCreate: function(){
            this.errors={};
            $("#create").modal('show');
        },

        createUser: function() {
            let url = 'users';
            if(this.addRol){
                this.newUsuario ={
                    ...this.newUsuario,
                    'role': 'admin',
                    'permissions': []
                }
            }else{
                this.newUsuario ={
                    ...this.newUsuario,
                    'role': null
                }
            }
            axios.post(url, this.newUsuario)
                .then(response => {

                    this.getUsuarios();

                    this.errors = {};
                    this.usuarioActual=response.data.usuario;
                    setTimeout(()=>{
                        $('#create').modal('hide');
                        toastr.success('New User created success');
                    },5000);

                    this.newUsuario=  {
                        'name':null,
                        'username':null,
                        'email': null,
                        'password': null,
                        'permissions': null,
                    } ;
                    this.addRol =false;
			    }).catch(error => {

                    this.errors=error.response.data.errors

            	});
        },
        showUsuario: function(usuario){
            this.fillUsuario={
                'id':usuario.id,
                'name':usuario.name,
                'username':usuario.username,
                'email': usuario.email,
                'permissions':usuario.permissions,
            }
            this.addRol= false;
            if(usuario.roles[0]){
                this.addRol= true
                this.fillUsuario = {
                    ...this.fillUsuario,
                    'role': 'admin'
                }
            }else{
                this.addRol= false
                this.fillUsuario = {
                    ...this.fillUsuario,
                    'role': null
                }
            }
            this.errors={};

          $("#edit").modal('show');
        },
        changeContra: function(){
            this.verContra = !this.verContra
            if(!this.verContra){
                this.changePassword = ''
            }
        },
        changeAdmin: function(){
            this.addRol= !this.addRol
            if(this.addRol){
                this.newUsuario ={
                    ...this.newUsuario,
                    'role': 'admin',
                    'permissions': []
                }
            }

        },
        updateUsuario: function(){
            if(this.verContra){
                this.fillUsuario ={
                ...this.fillUsuario,
                'password' : this.changePassword
                }
            };
            if(this.addRol){
                this.fillUsuario ={
                    ...this.fillUsuario,
                    'role' : 'admin',
                    'permissions': []
                }
            }else{
                this.fillUsuario ={
                    ...this.fillUsuario,
                    'role' : null
                }
            }
            //console.log(this.fillUsuario);
            let url='users/update/'+this.fillUsuario.id;
            axios.put(url, this.fillUsuario ).then((response)=>{
                this.getUsuarios();
                this.errors = {};
                this.usuarioActual=response.data.respuesta;
                toastr.success('User updated success');
                $("#edit").modal('hide');
                this.verContra = false;
                this.changePassword = ''
                this.addRol =false;
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            });
        }
    }

});
