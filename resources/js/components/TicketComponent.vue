<template>
    <div class="d-flex justify-content-between">
        <div class="text-nowrap">
            HODNOCENÍ:
        </div>
        <div class="progress bg-danger w-100 pr-3">
            <div class="progress-bar bg-success" role="progressbar"
                 style="width: {{ $ticket->vote_ratio }}%;" aria-valuenow="{{ $ticket->vote_ratio }}"
                 aria-valuemin="0" aria-valuemax="100"><i
                class="fas fa-thumbs-up"></i></div>
        </div>
    </div>
    @else
    <div class="btn-group">
        <a href="{{ route('upvote', $ticket->id) }}" class="btn btn-sm btn-success"><i
            class="fas fa-thumbs-up"></i></a>
        <a href="{{ route('downvote', $ticket->id) }}" class="btn btn-sm btn-danger"><i
            class="fas fa-thumbs-down"></i></a>
    </div>
    @endif
</template>

<script>

export default {

    data() {
        return {
            bet: 500,
            season: 365,
            month: 30,
            days: 10,
            season_result: 0,
            month_result: 0,
            days_result: 0,
        }
    },
    mounted() {
        axios.get('/api/calculator')
            .then(response => {
                this.season = response.data.season;
                this.month = response.data.month;
                this.days = response.data.days;
            });
    },
    filters: {
        numberFormat: function (value) {
            if (!value) return ''
            return new Intl.NumberFormat().format(value).toLocaleString().replace(/,/g, " ",);
        }
    },
    methods: {}
}
</script>
