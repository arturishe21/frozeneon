<template>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add money</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert-success text-center m-1 p-1" v-if="statusAfterSend == 'success'">Success</div>
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Enter sum</label>
                            <input type="number" class="form-control" v-model="amount" required>
                            <div class="invalid-feedback" v-if="errorMessage">
                                {{errorMessage}}
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" @click="add">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name : 'balance',

        data() {
            return {
                amount : 0,
                errorMessage : false,
                statusAfterSend : false
            }
        },

        methods : {
            add() {
                if (!this.amount){
                    this.errorMessage = 'Please write a sum.';

                    return;
                }

                this.axios.post('/balance/refill', {
                    'amount' : this.amount
                })
                .then(response => {
                    if (response.data.status == 'success') {
                        this.statusAfterSend = response.data.status;
                        this.amount = 0;

                        setTimeout(function () {
                            $('#addModal').modal('hide');
                            this.statusAfterSend = false;

                        }, 1500);

                    }
                })
                .catch(response => {
                    this.errorMessage = response.response.data.message
                })
            }
        }
    }
</script>