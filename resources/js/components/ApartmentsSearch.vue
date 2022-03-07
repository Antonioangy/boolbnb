<template>
    <input type="text" v-model="addresToSearch" class="w-100" @keyup.enter="geocoding">
</template>

<script>
// fonte https://developer.tomtom.com/blog/build-different/using-tomtom-maps-vue-3
export default {
    data() {
        return {
            addresToSearch: '',
            apiKey: 'CCNCApHEo3ZS5ewtvHkSDu7hMeAY7sQc', //tua key personale da developer.tomtom
            tt: window.tt,
            lng: '',
            lat: ''
        }
    },
    methods: {

        // conversione indirizzo da cercato in cordinate
        geocoding() {
            this.tt.services.geocode({
                key: this.apiKey,
                query: this.addresToSearch,
                bestResult: true,
                lenguage: 'it-It'
            }).then(res => {
                this.lng = res.position.lng;
                this.lat = res.position.lat;
                this.getApartmentList();
            });
        },

        // chiamta axios per ottenere gli appartamneti filtrati
        getApartmentList() {
            axios
            .get(`/apartments/search/${this.lng}/${this.lat}`)
            .then(res => console.log(res.data))
            .catch(err => console.error(err));
        }
    }
}
</script>
<style>
</style>