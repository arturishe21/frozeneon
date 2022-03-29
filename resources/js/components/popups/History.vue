<template>
    <div class="modal fade bd-example-modal-lg"
         id="history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <ul class="nav nav-tabs bordered">
                        <li class="nav-item">
                            <a href="#history_tab" class="nav-link active" data-toggle="tab">History</a>
                        </li>
                        <li class="nav-item">
                            <a href="#statistic_tab" class="nav-link" data-toggle="tab">Statistic</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent" style="padding: 20px">
                        <div class="tab-pane fade show active" id="history_tab" aria-labelledby="history_tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Object</th>
                                        <th>Action</th>
                                        <th>Object #id</th>
                                        <th>Amount</th>
                                        <th>Datetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="analytic in historyInfo.analytics">
                                        <td>{{analytic.object}}</td>
                                        <td>{{analytic.action}}</td>
                                        <td>{{analytic.object_id}}</td>
                                        <td>{{analytic.amount}}</td>
                                        <td>{{analytic.created_at}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="statistic_tab" aria-labelledby="statistic_tab">
                            <p>Balance : {{historyInfo.wallet_balance}}</p>
                            <p>Total refilled : {{historyInfo.wallet_total_refilled}}</p>
                            <p>Withdrawn : {{historyInfo.wallet_total_withdrawn}}</p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'history',
        props: ['historyInfo'],
    }
</script>