<template>
    <div>
        <!-- ricerca indirizzo -->
        <input type="text" v-model="addresToSearch" class="w-100 mb-3" @keyup.enter="geocoding">

        <!-- filtro numero minimo stanze -->
        <label for="rooms">N. stanze</label>
        <input type="number" min="1" max="8" v-model="nRooms" @keyup="getApartmentList" @click="getApartmentList">

        <!-- filtro numero minimo letti -->
        <label for="beds">N. letti</label>
        <input type="number" min="1" max="8" v-model="nBeds" @keyup="getApartmentList" @click="getApartmentList">

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
                        
                        <img v-if="apartment.images" class="rounded" :src="`/storage/assets/${apartment.images}`" alt="">
                        <img v-else src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAZlBMVEX///8AAADY2NixsbFdXV2RkZHCwsLNzc13d3dra2vJycnDw8NpaWnOzs6/v79zc3NjY2Nvb2/09PTe3t46OjpMTEw1NTWdnZ0YGBgPDw+Ojo7q6uovLy/U1NRZWVlUVFSlpaWEhISA7sPxAAAD40lEQVR4nO3c61LbMBAFYJsASZoCuZCkLVDo+79kmxGKbKM49lrai3q+Xy2k4DPe1a4n01QVAAAAAAAAAAAAgEbb3Vb6EvI6/qh/3klfRE6b+mQtfRn5PNXOd+kLyWVRe0vpS8njqQ6KvIvLuulW+nLSW9Rtxd3FbsDiejH04PH8p6KGxuYc676alxgxlOjjv799K69QF407eDIvLeKyE7AZsYihEQ6Zx/PXQqEWMDQWkYBF9WK4g/etr89LuYthTKw63ymkF+Ml6hRRqN0x0VbA0Nj0BqzsbzeXDpnAeMS+HvRM92II2D1Fmx7sDo3loICGh8aQEnWMLnDDAxrtxeunaJPBBe7aHOwyNzTGlKhjrFD7V7U4Uwvc2BJ1DBXquEMmMHPcjO9Bz0gvDlvV4kwscENXtbgQUe0CRy9RR/0CRxkTbcqHBvUUbVI9NGhzsEtxxKk96KkdGtN70FPai1/ffKFT+dQfe/OFTuHQSNWDnrpeTDEm2pSt4dNWtThVC1zqEnUUFWq6MdGmZmik2WRilGw36Q+ZQEXEPD3oKejFKU/0Q4g/9adc1eKEF7i8JeqILnAcAUV7Mecp2iS2wOWbg11CQ4OnRB2RQs21qsUJLHB8JeqwFyrXIRMwHzecPeix9mLuVS2OcYHL8UQ/BNtTv0SJOkwLHO+YaGMZGvynaBPD0OCeg13ZI8r1oJd5aEj2oJe1F6VL1Mn41J/2zRe6bENDvge9TL0Y7iDvJhOTZQ2XWtXiMixwekrUSV6oGsZEW+KhoWNMtCXdbmR30UsSRtTWg16yXpR5oh8i0dDI/+YLXZIFTsuqFpdggdPag97kXtR5ijZN7EWNc7Br0tDQXqLOhELVt6rFkRc4CyXqEAtV/yETkCLa6EGP0It6V7W40W/b6HqiH2LkAmerRJ1RC5zFgKN60dIp2jT4RP1lNGAz4qLvZS8mS9QJhbrredXK6h08mQ+5+BvDAUPEed+L9kZL1HGF+tz7mu26rl8fmC4ovbfnuv597cOmty8XvjF73x9TXxHRx/59duFbW/qHaf85FcCe/M9TWg+a7GPt9AyRzwP/JvGPnbkfq+HTxj8/4/VSnVIpSniHhDRIyAgJiZCQERISISEjJCRCQkZISISEjJCQCAkZISEREjJCQiIkZISEREjICAmJkJAREhIhISMkJEJCRkhIhISMkJAICRkhIRESMkJCIiRkhIRESMgICYmQkBESEiEhIyQkQkJGSEiEhIzyJjysb6WtD1kTKoKESNi1uv4rmSX/b+XSgb6gf7TABbuDdKSW17fUAatqe6NJ8jsIAAAAAAAAAAAA/72/G/wnrTzDrrcAAAAASUVORK5CYII=" alt="">

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
<style>
    @media screen and (max-width: 800px){
        .map{
            display: none;
        }

        .apartment{
            width: 100%;
        }

        .photo{
            display: none;
        }
    }
    .detail{
        width: 400px;
    }
</style>