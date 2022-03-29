export default {

    state: {
        user: {},
        comments : []
    },

    getters: {
        user: state => state.user,
        commentsAll: state => state.comments
    },

    mutations: {
        setUser (state, user) {
            state.user = user;
        },

        setComments (state, comments) {
            state.comments = comments;
        },
    },

    actions: {

        getUser: ({commit}) => {

            axios.post('/get-user')
                .then(response => {
                    commit('setUser', response.data)
                })
                .catch(err => consolel.log(err))

        },
    }
};
