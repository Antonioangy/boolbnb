<template>
    <div>
        <input type="text" v-model="addresToSearch" class="w-100" @keyup.enter="geocoding">

        <input type="range" v-model="radius" min="0" max="20000" @click.left="getApartmentList">

        <h1>Lista appartamenti</h1>

        <div class="items d-flex mb-2">
            <div class="item apartment">

                <div v-for="apartment, i in apartmentsList" :key="`apartment-${i}`" class="d-flex m-5">
                    <div class="photo">
                        <img class="rounded" :src="`/storage/assets/${apartment.images}`" alt="">
                    </div>
                    <div class="detail ml-2">
                        <h3>{{ apartment.title }}</h3>
                        <i class="fa-solid fa-star"></i>5.0  - {{ apartment.address }}
                        <div class="mt-2">
                            <p >Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                        <span class="mx-2">
                            <i class="fa-solid fa-house"></i>{{ apartment.rooms }}
                        </span>
                        <span class="mx-2">
                            <i class="fa-solid fa-bed"></i>{{ apartment.beds }}
                        </span>
                        <span class="mx-2">
                            <i class="fa-solid fa-bath"></i>{{ apartment.bathrooms }}
                        </span>
                        <span class="mx-2">
                            <i class="fa-solid fa-square"></i>{{ apartment.sq }}m<sup>2</sup>
                        </span>
                    </div><hr>
                </div>
            </div>
            <div class="item map">
                <SearchInMap/>
            </div>
        </div>

    </div>
</template>

<script>
import SearchInMap from '../components/SearchInMap.vue';

export default {
    components: {
        SearchInMap
    },
    data() {
        return {
            addresToSearch: '',
            apiKey: 'CCNCApHEo3ZS5ewtvHkSDu7hMeAY7sQc', //tua key personale da developer.tomtom
            tt: window.tt,
            lng: '',
            lat: '',
            radius: 20000,
            apartmentsList: []
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
            .get(`/apartments/search/lng=${this.lng}/lat=${this.lat}/radius=${this.radius}`)
            .then(res => {
                this.apartmentsList = res.data;
                console.log(res.data)
                })
            .catch(err => console.error(err));
        }
    }
}
</script>
<style>
</style>