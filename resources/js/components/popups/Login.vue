<template>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Log in</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert-danger text-center m-1 p-1" v-if="statusAfterSend == 'error'">User is not found</div>
                    <div class="alert-success text-center m-1 p-1" v-if="statusAfterSend == 'success'">User found</div>
                    <form v-if="statusAfterSend != 'success'">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Please enter login</label>
                            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" v-model="data.email" required>
                            <div class="invalid-feedback" v-if="error.email">
                                Please write a username.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Please enter password</label>
                            <input type="password" class="form-control" id="inputPassword" v-model="data.password" required>
                            <div class="invalid-feedback" v-show="error.password">
                                Please write a password.
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" @click.prevent="logIn">Login</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name : 'login',

        data() {
            return {
                data : {
                    email : '',
                    password : '',
                },
                error : {
                    email : false,
                    password : false
                },
                statusAfterSend : ''
            }
        },

        watch: {

            data: {
                handler(newValue, oldValue) {
                    this.checkErrors(newValue);
                },
                deep: true
            }
        },

        methods : {
            logIn () {

                this.checkErrors(this.data);

                if (!this.error.password && !this.error.email) {

                    this.axios.post('/login', this.data)
                        .then(response => {
                            this.statusAfterSend = response.data.status;
                            this.data.email = '';
                            this.data.password = '';

                            if (response.data.status == 'success') {
                                this.saveUserInStore(response.data.user);

                                setTimeout(function () {
                                    $('#loginModal').modal('hide');
                                }, 1500);
                            }

                        })
                        .catch(err => consolel.log(err))
                }
            },

            saveUserInStore(user)
            {
                this.$store.commit('setUser', user);
            },

            checkErrors (data) {
                this.error.email = !data.email;
                this.error.password = !data.password;
            }
        }
    }
</script>