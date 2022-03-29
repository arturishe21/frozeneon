<template>
    <div class="m-2">
        {{comment.user.personaname + ' - '}}
        <small class="text-muted">{{comment.text}}</small>
        <a role="button" @click="like">

            <svg class="bi bi-heart" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" clip-rule="evenodd"/>
            </svg>

            {{ countLikes }}
        </a>

        <a @click="reply" style="color: blue; cursor: pointer; margin-left: 20px" v-if="user">Reply</a>

        <form class="form-inline m-2" v-if="isReply">
            <div class="form-group">
                <input type="text" class="form-control" v-model="text">
            </div>
            <button type="button" class="btn btn-primary" @click="add(comment)">Add comment</button>
        </form>

        <comment v-for="commentItem in comments" :key="commentItem.id"
                :comment="commentItem"
                :user="user"
                :post="post"
                :comments="commentsReplies(commentItem.id)"
        ></comment>

    </div>
</template>

<script>

    import Vuex from 'vuex'

    export default {
        props: ['comment', 'user', 'post', 'comments'],
        data () {
            return {
                text: '',
                isReply : false,
                countLikes : this.comment.likes
            }
        },

        computed: Vuex.mapGetters(['commentsAll']),

        methods : {

            commentsReplies(id) {
                return this.commentsAll.filter(comment => comment.reply_id == id);
            },

            reply () {
                this.isReply = !this.isReply;
            },

            like () {
                this.axios.post(`/post/comment/${this.comment.id}/like`)
                    .then(response => {

                        if (response.data.status == 'error') {
                            alert(response.data.message);
                            return;
                        }

                        this.countLikes = response.data.likes;
                        this.$store.commit('setUser', response.data.user);
                     })
            },

            add (comment) {

                if (this.text) {
                    this.axios.post(`/post/${this.post.id}/comments/add`, {
                        'text' : this.text,
                        'reply_id' : comment.id
                    })
                    .then(response => {
                        this.updateListComments(response.data.comments);
                        this.text = '';
                        this.isReply = false;
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