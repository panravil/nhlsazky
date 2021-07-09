<template>
    <div class="card bg-primary text-dark shadow" id="calculator">
        <div
            class="card-header bg-primary d-flex flex-row justify-content-between align-content-center align-items-center">

            <h4 class="text-white m-0 text-uppercase">Kalkulačka
                výher</h4>
            <div class="btn-group btn-group-toggle">

                <label for="czk" class="btn btn-secondary" :class="{ 'active': currency === 'Kč' }">
                    <input type="radio" name="currency" v-model="currency" value="Kč" id="czk"> Kč
                </label>

                <label for="eur" class="btn btn-secondary" :class="{ 'active': currency === '€' }">
                    <input type="radio" name="currency" v-model="currency" value="€" id="eur"> €
                </label>
            </div>

        </div>
        <div class="card-body m-1 m-md-2 bg-white rounded">
            <div id="slidecontainer">
                <div class="d-flex flex-row justify-content-between align-items-end">
                    <label for="customRange1" class="h4 d-none d-md-block">Průměrná sázka:</label>
                    <label for="customRange1" class="h5 d-block d-md-none">Průměrná sázka:</label>
                    <div><span id="f" class="text-primary h2" style="font-weight:bold">{{ bet | numberFormat }}</span>
                        <span
                            class="h2">{{ currency }}</span></div>
                </div>
                <input type="range" v-model="bet" min="100" step="100" max="5000" class="custom-range"
                       id="customRange1">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <label for="membership-toggle" class="h4 m-0">Délka členství:</label>
                    <div class="btn-group btn-group-toggle rounded shadow" id="membership-toggle"
                         data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="duration" value="10" id="option1" checked>10 dní
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="duration" value="30" id="option2">30 dmí
                        </label>

                        <label class="btn btn-primary">
                            <input type="radio" name="duration" value="season" id="option2">Celá sezona
                        </label>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-between align-content-center align-items-center mt-4">
                <div class="text-left">
                    <p class="m-0"><span id="days" class="text-primary h3"
                                         style="font-weight:bold">{{ this.days * this.bet | numberFormat }}</span>
                        <span
                            class="h3">{{ currency }}</span></p>
                    <label class="h4">Za 10 dní</label>
                </div>
                <div class="text-right">
                    <p class="m-0"><span id="month" class="text-primary h3"
                                         style="font-weight:bold">{{ this.month * this.bet | numberFormat }}</span>
                        <span
                            class="h3">{{ currency }}</span></p>
                    <label class="h4">Za 30 dní</label>
                </div>
            </div>

            <div class="text-center d">
                <p class="m-0"><span id="season" class="text-primary h1 count_number"
                                     style="font-weight:bold">{{ this.season * this.bet | numberFormat }}</span>
                    <span
                        class="h1">{{ currency }}</span></p>
                <label class="h3">Za sezónu</label>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    data() {
        return {
            season: 365,
            month: 30,
            days: 10,
            season_result: 0,
            month_result: 0,
            days_result: 0,
            bet: 500,
            currency: "Kč",
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
