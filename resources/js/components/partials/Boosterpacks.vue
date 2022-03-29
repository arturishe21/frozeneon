<template>
    <div class="boosterpacks">
        <h1 class="text-center">Boosterpack's</h1>
        <div class="container">
            <div class="row">
                <div class="col-4" v-for="boosterpack in boosterpacks" v-if="boosterpacks">
                    <div class="card">
                        <img :src="'/images/box.png'" class="card-img-top" alt="Photo">
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-success my-2 my-sm-0" @click="buyPack(boosterpack)">Buy boosterpack {{boosterpack.price}}$
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <amount :amount="amount"></amount>
    </div>
</template>

<script>

    import Amount from "../popups/Amount";

    export default {
        name: 'boosterpacks',
        props: ['boosterpacks'],
        components: {Amount},
        data() {
            return {
                amount : 0,
            }
        },
        methods: {

            buyPack (boosterpack) {

                this.axios.post('/boosterpack/buy/' + boosterpack.id)
                    .then(response => {
                        if (response.data.status == 'success') {
                            this.$store.commit('setUser', response.data.user);
                            this.amount = response.data.likes;
                            setTimeout(function () {
                                $('#amountModal').modal('show');
                            }, 500);
                        }
                    })
                    .catch(response => {
                        alert(response.response.data.message);
                    })
            }
        }
    }
</script>