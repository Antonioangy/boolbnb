<template>
    <div id="searchbox">
        <input name="address" type="text" placeholder="Cerca Indirizzo" class="p-2 h5" v-model="addressQuery" @keyup="geocoding">
        
        <input name="latitude" type="text" class="d-none" v-model="lat">

        <input name="longitude" type="text" class="d-none" v-model="lng">
    </div>
</template>

<script>
export default {

    data() {
        return {
            addressQuery: '',
            apiKey: 'CCNCApHEo3ZS5ewtvHkSDu7hMeAY7sQc', //tua key personale da developer.tomtom
            tt: window.tt,
            lng: '',
            lat: '',
            output: ''         
        }
    },

    methods: {

        searchAddress() {

            this.tt.services.fuzzySearch({
                key: this.apiKey,
                query: this.addressQuery,


            })
            .autocomplete({
                key: this.apiKey,
                language: 'it-IT'

            })
            .go().then(r => console.log(r));
        },

        geocoding() {
            this.tt.services.geocode({
                key: this.apiKey,
                query: this.addressQuery,
                bestResult: true,
                lenguage: 'it-It'
            }).then(res => {
                this.lng = res.position.lng;
                this.lat = res.position.lat;
            });
        },
    },

    mounted() {
        console.log('component mounted');
    }
}
</script>

<style>

</style>