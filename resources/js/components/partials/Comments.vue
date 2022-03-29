<template>
    <div>
        <div v-if="!user" class="alert-info m-1 p-2 text-center">You must be logged in to add comments.</div>
        <form class="form-inline m-2" v-else>
            <div class="form-group">
                <input type="text" class="form-control" id="addComment" v-model="text">
            </div>
            <button type="button" class="btn btn-primary" @click="add()">Add comment</button>
        </form>
        <div>
            <h4>All comments</h4>
            <div class="card-text"
                 v-for="comment in commentsAll">
                <comment
                        v-if="comment.reply_id == null"
                        :comment="comment"
                        :user="user"
                        :post="post"
                        :comments="commentsReplies(comment.id)"
                ></comment>
            </div>
            <div class="text-center" v-if="commentsAll.length == 0">Comments not found</div>
        </div>
    </div>

</template>

<script>

    import Vuex from 'vuex'

    export default {
        name : 'comments',
        props : ['post'],
        data () {
            return {
                text: '',
                reply_id : null
            }
        },

        computed: Vuex.mapGetters(['user', 'commentsAll']),

        watch:  {
            post (newQuestion, oldQuestion) {
                this.updateListComments(this.post.comments);
            },
        },

        mounted() {
            this.updateListComments(this.post.comments);
        },

        methods : {

            commentsReplies(id) {
                return this.commentsAll.filter(comment => comment.reply_id == id);
            },

            add() {
                if (this.text) {
                    this.axios.post(`/post/${this.post.id}/comments/add`, {
                        'text' : this.text,
                        'reply_id' : this.reply_id
                    })
                        .then(response => {
                            this.updateListComments(response.data.comments);
                            this.text = '';
                        })
                        .catch(err => console.log(err))
                }
            },

            updateListComments (comments) {
                this.$store.commit('setComments', comments);
            }
        }

    }
</script>