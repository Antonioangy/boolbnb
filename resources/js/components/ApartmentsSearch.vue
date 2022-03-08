<template>
    <div>
        <!-- ricerca indirizzo -->
        <input type="text" v-model="addresToSearch" class="w-100" @keyup.enter="geocoding">

        <!-- filtro numero minimo stanze -->
        <label for="rooms">N. stanze</label>
        <input type="number" min="1" max="8" v-model="nRooms" @keyup="getApartmentList">

        <!-- filtro numero minimo letti -->
        <label for="beds">N. letti</label>
        <input type="number" min="1" max="8" v-model="nBeds" @keyup="getApartmentList">

        <!-- <label for="beds">Servizi</label>
        <span v-for="service, i in servicesList" :key="`service-${i}`">
            <input  type="checkbox" :name="service.name" :id="service.id" :value="service.name" v-model="selectedServices" @click="getApartmentList"> {{ service.name }}
        </span>

        <div>
            {{ selectedServices }}
        </div> -->

        <!-- filtro raggio di ricerca -->
        <label for="radius">Raggio di Ricerca</label>
        <input type="range" v-model="radius" min="0" max="20000" @click.left="getApartmentList">
        {{ radius /1000 }} Km

        <h1>Lista appartamenti</h1>

        <div class="items d-flex mb-2">
            <div class="item apartment">

                <div v-for="apartment, i in apartmentsList" :key="`apartment-${i}`" class="d-flex m-5">
                    <div class="photo">
                        <img class="rounded" :src="`/storage/assets/${apartment.images}`" alt="">
                    </div>
                    <div class="detail ml-2">

                        <!-- titolo appartamento e link a pagina di dettaglio -->
                        <a class="text-decoration-none" :href="`/apartment/show/${apartment.id}`">
                            <h3>{{ apartment.title }}</h3>
                        </a>

                        <!-- indirizzo appartamento -->
                        <i class="fa-solid fa-star"></i>5.0  - {{ apartment.address }}
                        <div class="mt-2">
                            <p >Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </div>

                        <!-- numero stanze appartamento -->
                        <span class="mx-2">
                            <i class="fa-solid fa-house"></i>{{ apartment.rooms }}
                        </span>

                        <!-- numero letti appartamento -->
                        <span class="mx-2">
                            <i class="fa-solid fa-bed"></i>{{ apartment.beds }}
                        </span>

                        <!-- numero bagni appartamento -->
                        <span class="mx-2">
                            <i class="fa-solid fa-bath"></i>{{ apartment.bathrooms }}
                        </span>

                        <!-- numero metri quadri appartamento -->
                        <span class="mx-2">
                            <i class="fa-solid fa-square"></i>{{ apartment.sq }}m<sup>2</sup>
                        </span>
                    </div><hr>
                </div>
            </div>

            <!-- mappa risultati -->
            <div class="item map">
                <SearchInMap ref="map" :center="[this.lng, this.lat]" :apartmentsFound="this.apartmentsCoordinates"/>
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
            lng: '', // longitudine ricerca
            lat: '', // latitude ricerca
            radius: 20000, // raggio ricerca
            nRooms: 1, // numero minimo stanze
            nBeds: 1, // numero minimo letti
            apartmentsList: [], // lista risultati
            // servicesList: [],
            // selectedServices: []
            apartmentsCoordinates: [] // coordinate degli appartamenti trovati
        }
    },

    props: {

        // indirzzo inserito in homepaage
        firstQuery: String, 
    },

    methods: {

        // conversione indirizzo cercato in coordinate
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

                // richiamo funzione in componente figlio (mappa)
                setTimeout (() => this.$refs.map.getMap(), 900);
            });
        },

        // chiamata axios per ottenere gli appartamenti filtrati
        getApartmentList() {
            axios
            .get(`/apartments/search/lng=${this.lng}/lat=${this.lat}/radius=${this.radius}/rooms=${this.nRooms}/beds=${this.nBeds}`)
            .then(res => {
                this.apartmentsList = res.data;

                // salvo coordinate degli appartamenti trovati per visualizzare la posizione sulla mappa
                this.apartmentsList.forEach(ele => {
                    let obj = {
                        lng: ele.longitude,
                        lat: ele.latitude
                    }
                    this.apartmentsCoordinates.push(obj);
                    })
                })
            .catch(err => console.error(err));
        },

        // chiamata axios per ottenere lista sservizi
        getServicesList() {
            axios
            .get('/services/list')
            .then(res => this.servicesList = res.data)
            .catch(err => console.error(err));
        }
    },

    created() {
        this.addresToSearch = this.firstQuery;
        this.geocoding();
        // this.getServicesList();
    },
}
</script>
<style>
</style>