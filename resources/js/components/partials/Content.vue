<template>
    <div>
        <div class="main">
            <div class="posts">
                <h1 class="text-center">Posts</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-4" v-for="post in posts" v-if="posts">
                            <div class="card">
                                <img :src="post.img" class="card-img-top" alt="Photo">
                                <div class="card-body">
                                    <h5 class="card-title">Post - {{post.id}}</h5>
                                    <p class="card-text">{{post.text}}</p>
                                    <button type="button" class="btn btn-outline-success my-2 my-sm-0" @click="openPost(post)">Open post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <boosterpacks :boosterpacks="boosterpacks"></boosterpacks>

            </div>
        </div>
        <PostPage :post="post" v-if="post"></PostPage>

    </div>

</template>

<script>

    import PostPage from "../popups/PostPage";
    import Boosterpacks from "../partials/Boosterpacks";

    export default {
        name : 'content-page',
        components: {PostPage, Boosterpacks},
        data() {
            return {
                post: false,
                posts: [],
                boosterpacks: [],
            }
        },

        created() {

            this.axios.get('/get-content-for-main')
                .then(response => {
                    this.posts = response.data.posts;
                    this.boosterpacks = response.data.boosterpacks;
                })
                .catch(err => console.log(err))
        },

        methods: {

            openPost (post) {

                this.axios.get('/get-post/' + post.id)
                    .then(response => {
                        this.post = response.data;

                        setTimeout(function () {
                            $('#postModal').modal('show');
                        }, 500);

                    })
                    .catch(err => console.log(err))
            },

        }
    }
</script>