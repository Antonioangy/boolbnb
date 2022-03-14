<template>
    <section class="row m-0 py-4">
        <div class="col-12 col-md-6">
            <div class="d-flex flex-column">

                <!-- ricerca indirizzo -->
                <input type="text" placeholder="Dove vuoi andare?" v-model="addresToSearch" class="w-100 mb-3 rounded-pill px-2 px-2" @keyup.enter="geocoding">
                <div class="d-flex align-items-center justify-content-around py-1">

                    <!-- filtro numero minimo stanze -->
                    <span class="d-flex align-items-center">
                        <label for="rooms">N. stanze</label>
                        <input type="number" class="rounded-pill px-2" min="1" max="8" v-model="nRooms" @keyup="getApartmentList" @click="getApartmentList">
                    </span>

                    <!-- filtro numero minimo letti -->
                    <span class="d-flex align-items-center">
                        <label for="beds">N. letti</label>
                        <input type="number" class="rounded-pill px-2" min="1" max="8" v-model="nBeds" @keyup="getApartmentList" @click="getApartmentList">
                    </span>

                    <!-- <label for="beds">Servizi</label>
                    <span v-for="service, i in servicesList" :key="`service-${i}`">
                        <input  type="checkbox" :name="service.name" :id="service.id" :value="service.name" v-model="selectedServices" @click="getApartmentList"> {{ service.name }}
                    </span>

                    <div>
                        {{ selectedServices }}
                    </div> -->

                    <!-- filtro raggio di ricerca -->
                    <span class="d-flex align-items-center">
                        <label for="radius">Raggio di Ricerca</label>
                        <input type="range" v-model="radius" min="0" max="20000" step="100" @click.left="getApartmentList">
                        <span id="km_tag">
                            {{ parseFloat(radius/1000).toFixed(1) }} Km
                        </span>
                    </span>
                </div>
            </div>
            <div>

                <div v-for="apartment, i in apartmentsList" :key="`apartment-${i}`" class="d-flex py-3" :class="apartment.sponsor ? 'sponsored' : null">
                        
                    <img v-if="apartment.images" class="rounded img-thumbnail apartment_thumb" :src="`/storage/assets/${apartment.images}`" alt="">
                    <img v-else class="rounded img-thumbnail apartment_thumb" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAZlBMVEX///8AAADY2NixsbFdXV2RkZHCwsLNzc13d3dra2vJycnDw8NpaWnOzs6/v79zc3NjY2Nvb2/09PTe3t46OjpMTEw1NTWdnZ0YGBgPDw+Ojo7q6uovLy/U1NRZWVlUVFSlpaWEhISA7sPxAAAD40lEQVR4nO3c61LbMBAFYJsASZoCuZCkLVDo+79kmxGKbKM49lrai3q+Xy2k4DPe1a4n01QVAAAAAAAAAAAAgEbb3Vb6EvI6/qh/3klfRE6b+mQtfRn5PNXOd+kLyWVRe0vpS8njqQ6KvIvLuulW+nLSW9Rtxd3FbsDiejH04PH8p6KGxuYc676alxgxlOjjv799K69QF407eDIvLeKyE7AZsYihEQ6Zx/PXQqEWMDQWkYBF9WK4g/etr89LuYthTKw63ymkF+Ml6hRRqN0x0VbA0Nj0BqzsbzeXDpnAeMS+HvRM92II2D1Fmx7sDo3loICGh8aQEnWMLnDDAxrtxeunaJPBBe7aHOwyNzTGlKhjrFD7V7U4Uwvc2BJ1DBXquEMmMHPcjO9Bz0gvDlvV4kwscENXtbgQUe0CRy9RR/0CRxkTbcqHBvUUbVI9NGhzsEtxxKk96KkdGtN70FPai1/ffKFT+dQfe/OFTuHQSNWDnrpeTDEm2pSt4dNWtThVC1zqEnUUFWq6MdGmZmik2WRilGw36Q+ZQEXEPD3oKejFKU/0Q4g/9adc1eKEF7i8JeqILnAcAUV7Mecp2iS2wOWbg11CQ4OnRB2RQs21qsUJLHB8JeqwFyrXIRMwHzecPeix9mLuVS2OcYHL8UQ/BNtTv0SJOkwLHO+YaGMZGvynaBPD0OCeg13ZI8r1oJd5aEj2oJe1F6VL1Mn41J/2zRe6bENDvge9TL0Y7iDvJhOTZQ2XWtXiMixwekrUSV6oGsZEW+KhoWNMtCXdbmR30UsSRtTWg16yXpR5oh8i0dDI/+YLXZIFTsuqFpdggdPag97kXtR5ijZN7EWNc7Br0tDQXqLOhELVt6rFkRc4CyXqEAtV/yETkCLa6EGP0It6V7W40W/b6HqiH2LkAmerRJ1RC5zFgKN60dIp2jT4RP1lNGAz4qLvZS8mS9QJhbrredXK6h08mQ+5+BvDAUPEed+L9kZL1HGF+tz7mu26rl8fmC4ovbfnuv597cOmty8XvjF73x9TXxHRx/59duFbW/qHaf85FcCe/M9TWg+a7GPt9AyRzwP/JvGPnbkfq+HTxj8/4/VSnVIpSniHhDRIyAgJiZCQERISISEjJCRCQkZISISEjJCQCAkZISEREjJCQiIkZISEREjICAmJkJAREhIhISMkJEJCRkhIhISMkJAICRkhIRESMkJCIiRkhIRESMgICYmQkBESEiEhIyQkQkJGSEiEhIzyJjysb6WtD1kTKoKESNi1uv4rmSX/b+XSgb6gf7TABbuDdKSW17fUAatqe6NJ8jsIAAAAAAAAAAAA/72/G/wnrTzDrrcAAAAASUVORK5CYII=" alt="">

                    <div class="p-3">

                        <!-- titolo appartamento e link a pagina di dettaglio -->
                        <a class="text-decoration-none" :href="`/apartment/show/${apartment.id}`">
                            <h4>
                                {{ apartment.title }} 
                                <i class="fa-solid fa-star text-orange" v-show="apartment.sponsor"></i>
                            </h4>
                        </a>

                        <!-- indirizzo appartamento -->
                        <span class="text-darkBlue">
                            {{ apartment.address }}
                        </span>

                        <!-- descrizione appartamento  -->
                        

                        <div>

                            <!-- numero stanze appartamento -->
                            <span class="">
                                <i class="fa-solid fa-house"></i> Stanze: {{ apartment.rooms }} 
                            </span>

                            <!-- numero letti appartamento -->
                            <span class="mx-2">
                                <i class="fa-solid fa-bed"></i> Letti: {{ apartment.beds }}
                            </span>

                            <!-- numero bagni appartamento -->
                            <span class="mx-2">
                                <i class="fa-solid fa-bath"></i> Bagni: {{ apartment.bathrooms }}
                            </span>

                            <!-- numero metri quadri appartamento -->
                            <span class="mx-2">
                                <i class="fa-solid fa-square"></i> {{ apartment.sq }}m<sup>2</sup>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- mappa risultati -->
        <div class="col-6 d-none d-md-block">
            <SearchInMap class="sticky-top" ref="map" :center="[this.lng, this.lat]" :apartmentsFound="this.apartmentsCoordinates"/>
        </div>
    </section>
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

        // indirizzo inserito in homepage
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
                
            });
        },

        // chiamata axios per ottenere gli appartamenti filtrati
        getApartmentList() {
            axios
            .get(`/apartments/search/lng=${this.lng}/lat=${this.lat}/radius=${this.radius}/rooms=${this.nRooms}/beds=${this.nBeds}`)
            .then(res => {
                this.apartmentsList = res.data;

                // svuoto array coordinate degli appartamenti trovati
                this.apartmentsCoordinates = [];

                // salvo coordinate degli appartamenti trovati per visualizzare la posizione sulla mappa
                this.apartmentsList.forEach(ele => {
                    let obj = {
                        lng: ele.longitude,
                        lat: ele.latitude
                    }
                    this.apartmentsCoordinates.push(obj);
                });
                this.$refs.map.moveMap();
                setTimeout(() => this.$refs.map.addMarker(), 500);
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
        // richiamo funzione in componente figlio (mappa)
        setTimeout (() => this.$refs.map.getMap(), 200);
        // this.getServicesList();
    },
}
</script>
<style lang="scss" scoped>
@import '../../sass/variables';
    #km_tag {
        margin-left: 8px;
        width: 60px
    }

    input {
        border: 1px solid black
    }

    label {
        margin: 0;
        padding-bottom: 2px;
        margin-right: 8px;
    }

    .sponsored {
        border-bottom: 1px solid $orange;
    }

    .apartment_thumb {
    width: 300px;
    height: 200px;
    object-fit: contain;
    }
</style>