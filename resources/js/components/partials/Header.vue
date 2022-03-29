<template>
    <div class="header">
        <login></login>
        <balance></balance>
        <history :historyInfo="historyInfo"></history>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

                <a @click="logout" class="btn btn-primary my-2 my-sm-0" v-if="user"
                   data-target="#loginModal">Log out, {{user.personaname}}
                </a>
                <button type="button" class="btn btn-success m-2" data-toggle="modal"  v-else
                        data-target="#loginModal">Log IN
                </button>

                <button type="button" class="btn btn-success m-2" data-toggle="modal" v-if="user"
                        data-target="#addModal">Add balance
                </button>

                <button type="button" class="btn btn-success m-2" data-toggle="modal" v-if="user" @click="historyShow">History
                </button>

                <a href="" role="button" v-if="user">
                    Likes: {{user.likes_balance}}
                </a>

            </div>
        </nav>

    </div>
</template>

<script>

    import Login from "../popups/Login";
    import Balance from "../popups/Balance";
    import History from "../popups/History";
    import Vuex from 'vuex'

    export default {
        name : 'header-page',

        components: {
            Login,
            Balance,
            History
        },

        data () {
            return {
                historyInfo: {}
            }
        },

        methods: {

            historyShow() {

                this.axios.post('/history')
                    .then(response => {

                        this.historyInfo = response.data;

                        $('#history').modal('show');
                    })
                    .catch(err => console.log(err))
            },

            logout () {
                this.axios.post('/logout-user')
                    .then(response => {
                        this.$store.commit('setUser', null);
                    })
                    .catch(err => console.log(err))
            },
            ...
            Vuex.mapActions(['getUser'])
        },
        computed: Vuex.mapGetters(['user']),

        mounted: async function() {
            await this.getUser();
        },
    }
</script>